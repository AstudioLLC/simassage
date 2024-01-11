<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentsInformation\ActiveDepartmentsInformationRequest;
use App\Http\Requests\DepartmentsInformation\DeleteDepartmentsInformationRequest;
use App\Http\Requests\DepartmentsInformation\ForceDestroyDepartmentsInformationRequest;
use App\Http\Requests\DepartmentsInformation\RestoreDepartmentsInformationRequest;
use App\Http\Requests\DepartmentsInformation\StoreDepartmentsInformationRequest;
use App\Http\Requests\DepartmentsInformation\UpdateDepartmentsInformationRequest;
use App\Models\Department;
use App\Models\DepartmentsCategory;
use App\Models\DepartmentsInformation;
use App\Models\Gallery;
use App\Services\ImageUploader\ImageUploader;
use App\Traits\InteractsWithSortable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Yajra\DataTables\Facades\DataTables;

class DepartmentInformationController extends AdminBaseController
{
    use InteractsWithSortable;

    /**
     * @var string
     */
    protected $modelClass = DepartmentsInformation::class;

    /**
     * @var mixed
     */
    protected $model;

    public function __construct()
    {
        parent::__construct();

        $this->model = new $this->modelClass;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()
            ->view('admin.pages.departments.index');
    }

    public function listPortion(Request $request)
    {

        //Session::put('sort', $request->get('start') ?? 0);
//        $model = $this->model::query();
        $model = $this->model::query()->withCount(['gallery']);

        $search = $request->input('search');

        $result = DataTables::eloquent($model)
            ->order(function (Builder $query) use ($request) {
                if ($request->has('order')) {
                    $order = Arr::first($request->input('order'));
                    $orderColumn = $request->input("columns.{$order['column']}.data");
                    $orderDir = $order['dir'];

                    $query->orderBy($orderColumn, $orderDir);
                } else {
                    $query->orderBy('id', 'desc');
                }
            })->filter(function (Builder $query) use ($search) {
                if (!empty($search['value'])) {
                    $query->where('name', 'LIKE', '%' . $search['value'] . '%');
                    $query->orWhere('created_at', 'LIKE', '%' . $search['value'] . '%');
                }
            });

        $result->editColumn('active', function (DepartmentsInformation $item) {
            $checked = $item->active ? ' checked' : '';
            return '<label class="custom-toggle active-changer">
                    <input type="checkbox" value="'.$item->active.'" '.$checked.'>
                    <span class="custom-toggle-slider rounded-circle"></span>
                </label>';
        });

        $result->editColumn('title', function (DepartmentsInformation $item) {
            return $item->title;
        });

        $result->editColumn('created_at', function (DepartmentsInformation $item) {
            return $item->created_at->format('d/m/Y');//->calendar();
        });

        return $result->rawColumns(['active'])->toArray();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(int $parent_id)
    {
        $edit = false;
        $backUrl = route('admin.departments.index', ['parentId' => $parent_id]);

        $imageSmallSizes = $this->model::$imageSmallSizes ?? null;
        $imageSmallSize = '';
        if ($imageSmallSizes) {
            $imageSmallSize = ' (' . $imageSmallSizes[0]['width'] . 'x' . $imageSmallSizes[0]['height'] . ')';
        }

        $imageBigSizes = $this->model::$imageBigSizes ?? null;
        $imageBigSize = '';
        if ($imageBigSizes) {
            $imageBigSize = ' (' . $imageBigSizes[0]['width'] . 'x' . $imageBigSizes[0]['height'] . ')';
        }
        return response()
            ->view('admin.pages.departmentsInformation.create', compact('edit', 'backUrl', 'imageSmallSize', 'imageBigSize', 'parent_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDepartmentsInformationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreDepartmentsInformationRequest $request)
    {
       $item = $this->model->create($request->except('_token', '_method'));
        $DepartmentsCategory = new DepartmentsCategory();
        $DepartmentsCategory->department_page_id = $item->parent_id;
        $DepartmentsCategory->general_information = $item->id;
        $DepartmentsCategory->save();


        return redirect()
            ->route('admin.departments.index', ['parentId' => $item->parent_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {

        $item = $this->model::where('parent_id', $id)->first();
        if (!$item){

           return redirect()->route('admin.departmentsInformation.create',['parent_id' => $id]);
        }
        $edit = true;
        $parent_id = $id;
        $backUrl = route('admin.departments.index', ['parentId' => $id]);

        $imageSmallSizes = $this->model::$imageSmallSizes ?? null;
        $imageSmallSize = '';
        if ($imageSmallSizes) {
            $imageSmallSize = ' (' . $imageSmallSizes[0]['width'] . 'x' . $imageSmallSizes[0]['height'] . ')';
        }

        $imageBigSizes = $this->model::$imageBigSizes ?? null;
        $imageBigSize = '';
        if ($imageBigSizes) {
            $imageBigSize = ' (' . $imageBigSizes[0]['width'] . 'x' . $imageBigSizes[0]['height'] . ')';
        }

//dd($images);
        return response()
            ->view('admin.pages.departmentsInformation.edit', compact('edit', 'backUrl', 'imageSmallSize', 'imageBigSize', 'item', 'parent_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDepartmentsInformationRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateDepartmentsInformationRequest $request, int $id)
    {
        Department::where('static', 'general-information')->update(['title'=>$request->title]);
        $item = $this->model::findOrFail($id);
        $item->update($request->except('_token', '_method'));
        $DepartmentsCategory = DepartmentsCategory::where('department_page_id', $item->parent_id)->whereNull(['price_id','members_id','service_id'])->update(['general_information'=>$item->id]);
        if ($DepartmentsCategory == 0){
            $DepartmentsCategory = new DepartmentsCategory();
            $DepartmentsCategory->department_page_id = $item->parent_id;
            $DepartmentsCategory->general_information = $item->id;
            $DepartmentsCategory->save();
        }
        return redirect()
            ->route('admin.departments.index', ['parentId' => $item->parent_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteDepartmentsInformationRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteDepartmentsInformationRequest $request, int $id)
    {

        $item = $this->model::findOrFail($id);
        $result = ['success' => false];
        $item->delete();
        $result['success'] = true;

        return response()->json($result);
    }

    /**
     * Activate/Deactivate the specified resource from storage
     *
     * @param ActiveDepartmentsInformationRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function active(ActiveDepartmentsInformationRequest $request, int $id)
    {
        $item = $this->model::findOrFail($id);
        $result = ['success' => false];
        $item->active = $request->value;
        if ($item->save()) {
            $result['success'] = true;
        }

        return response()->json($result);
    }

    /**
     * Displays All trashed resources from storage
     *
     * @return Response
     */
    public function onlyTrashed()
    {
        $items = $this->model::onlyTrashed()->sort()->get();

        return response()
            ->view('admin.pages.departmentsInformation.trash.index', compact('items'));
    }

    /**
     * Restores the specified resource from trash
     *
     * @param RestoreDepartmentsInformationRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(RestoreDepartmentsInformationRequest $request, int $id)
    {
        $item = $this->model::onlyTrashed()->findOrFail($id);
        $result = ['success' => false];
        $item->restore();
        $result['success'] = true;

        return response()->json($result);
    }

    /**
     * ForceDeletes the specified resource from storage
     *
     * @param ForceDestroyDepartmentsInformationRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function forceDestroy(ForceDestroyDepartmentsInformationRequest $request, int $id)
    {
        $item = $this->model::withTrashed()->findOrFail($id);
        $result = ['success' => false];
        if ($item->forceDelete()) {
            $result['success'] = true;
        }

        return response()->json($result);
    }

    public function deleteImage(Request $request)
    {
        $result = ['success' => false];
        $id = $request->input('gallery_second');
        if ($id && is_id($id)) {
            if (Gallery::destroy($id)) $result['success'] = true;
        }
        return response()->json($result);
    }
}
