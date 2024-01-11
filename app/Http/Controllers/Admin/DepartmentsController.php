<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Departments\ActiveDepartmentsRequest;
use App\Http\Requests\Departments\DeleteDepartmentsRequest;
use App\Http\Requests\Departments\ForceDestroyDepartmentsRequest;
use App\Http\Requests\Departments\RestoreDepartmentsRequest;
use App\Http\Requests\Departments\StoreDepartmentsRequest;
use App\Http\Requests\Departments\UpdateDepartmentsRequest;
use App\Models\Department;
use App\Models\DepartmentsCategory;
use App\Models\Member;
use App\Models\MembersCategory;
use App\Models\Price;
use App\Models\Service;
use App\Traits\InteractsWithSortable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Yajra\DataTables\Facades\DataTables;

class DepartmentsController extends AdminBaseController
{
    use InteractsWithSortable;

    /**
     * @var string
     */
    protected $modelClass = Department::class;

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

    public function index($parentId)
    {
        $items = $this->model::whereNotNull('static')->orWhere('parent_id', $parentId)->withCount(['gallery'])
            ->sort()
            ->get();

        return response()
            ->view('admin.pages.departments.index', compact('items', 'parentId'));
    }
    public function service($parentId){
        $edit = true;
        $services = Service::where(['active'=>true])->get();
        $departmentsCategory = DepartmentsCategory::where('department_page_id', $parentId)->get()->pluck('service_id')->toArray();
        $departmentService = Department::where('static', 'services')->first();
        return response()->view('admin.pages.departments.services', compact('parentId', 'edit','services', 'departmentsCategory', 'departmentService'));
    }
    public function serviceAdd($id, Request $request){
        $request->validate([
            'service_ids' => 'array'
        ]);

        Department::where('static', 'services')->update(['title'=>$request->title]);
        $departmentsCategory = DepartmentsCategory::addOrEdit($id, $request->service_ids);
        return redirect()->back();
    }
    public function personnel($parentId){
        $edit = true;
        $personnel = Member::where(['active'=>true])->get();
        $departmentsCategory = DepartmentsCategory::where('department_page_id', $parentId)->get()->pluck('members_id')->toArray();
        $departmentPersonnel = Department::where('static', 'personnel')->first();
        return response()->view('admin.pages.departments.members', compact('parentId', 'edit','personnel', 'departmentsCategory', 'departmentPersonnel'));
    }
    public function personnelAdd($id, Request $request){
        $request->validate([
            'members_ids' => 'array'
        ]);
        Department::where('static', 'personnel')->update(['title'=>$request->title]);
        $departmentsCategory = DepartmentsCategory::addOrEditMembers($id, $request->members_ids);
        MembersCategory::addOrEdit($id, $request->members_ids);
        return redirect()->back();
    }
  public function price($parentId){
        $edit = true;
        $prices = Price::where(['active'=>true])->get();
        $departmentsCategory = DepartmentsCategory::where('department_page_id', $parentId)->get()->pluck('price_id')->toArray();
        $departmentPrice = Department::where('static', 'price')->first();
        return response()->view('admin.pages.departments.prices', compact('parentId', 'edit','prices', 'departmentsCategory','departmentPrice'));
    }
    public function priceAdd($id, Request $request){
        $request->validate([
            'price_ids' => 'array'
        ]);
        Department::where('static', 'price')->update(['title'=>$request->title]);
        $departmentsCategory = DepartmentsCategory::addOrEditPrices($id, $request->price_ids);
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($parentId)
    {
        $edit = false;
        $backUrl = route('admin.departments.index',['parentId' => $parentId]);

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
            ->view('admin.pages.departments.create', compact('edit', 'backUrl', 'imageSmallSize', 'imageBigSize','parentId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDepartmentsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreDepartmentsRequest $request)
    {

        $this->model->create($request->except('_token', '_method'));

        return redirect()
            ->route('admin.departments.index',['parentId' => $request->parent_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $item = $this->model::findOrFail($id);
        $parentId = $item->parent_id;
        $edit = true;
        $backUrl = route('admin.departments.index',['parentId' => $parentId]);

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
            ->view('admin.pages.departments.edit', compact('edit', 'backUrl', 'imageSmallSize', 'imageBigSize', 'item','parentId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDepartmentsRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateDepartmentsRequest $request, int $id)
    {

        $item = $this->model::findOrFail($id);

        $parentId = $item->parent_id;
        $item->update($request->except('_token', '_method',
            'title',
//            'parent_id',
            'url',
            'active',
            'short',
            'content',
            'seo_title',
            'seo_description',
            'seo_keywords',
            'updated_at'));
        merge_model($request->except('_token', '_method'), $item, [
            'title',
//            'parent_id',
            'url',
            'active',
            'short',
            'content',
            'seo_title',
            'seo_description',
            'seo_keywords',
            'updated_at']);
        $item->save();
//        $item->update($request->except('_token', '_method'));


        return redirect()->route('admin.departments.index', ['parentId' => $parentId]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteDepartmentsRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteDepartmentsRequest $request, int $id)
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
     * @param ActiveDepartmentsRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function active(ActiveDepartmentsRequest $request, int $id)
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
            ->view('admin.pages.departments.trash.index', compact('items'));
    }

    /**
     * Restores the specified resource from trash
     *
     * @param RestoreDepartmentsRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(RestoreDepartmentsRequest $request, int $id)
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
     * @param ForceDestroyDepartmentsRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function forceDestroy(ForceDestroyDepartmentsRequest $request, int $id)
    {
        $item = $this->model::withTrashed()->findOrFail($id);
        $result = ['success' => false];
        if ($item->forceDelete()) {
            $result['success'] = true;
        }

        return response()->json($result);
    }
}
