<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Members\ActiveMembersRequest;
use App\Http\Requests\Members\DeleteMembersRequest;
use App\Http\Requests\Members\ForceDestroyMembersRequest;
use App\Http\Requests\Members\RestoreMembersRequest;
use App\Http\Requests\Members\StoreMembersRequest;
use App\Http\Requests\Members\UpdateMembersRequest;
use App\Models\Member;
use App\Models\MembersCategory;
use App\Models\Page;
use App\Traits\InteractsWithSortable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Yajra\DataTables\Facades\DataTables;

class MembersController extends AdminBaseController
{
    use InteractsWithSortable;

    /**
     * @var string
     */
    protected $modelClass = Member::class;

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
            ->view('admin.pages.members.index');
    }

    public function listPortion(Request $request)
    {
        $model = $this->model::query()->withCount(['gallery'])->withCount(['videos'])->sort();

        $search = $request->input('search');
        $result = DataTables::eloquent($model)
            ->order(function (Builder $query) use ($request) {
                if ($request->has('order')) {
                    $order = Arr::first($request->input('order'));
                    $orderColumn = $request->input("columns.{$order['column']}.data");
                    $orderDir = $order['dir'];

                    $query->orderBy('ordering');
                } else {
                    $query->orderBy('ordering', 'desc');
                }
            })->filter(function (Builder $query) use ($search) {
                if (!empty($search['value'])) {
                    $query->where('title', 'LIKE', '%' . $search['value'] . '%');
                    $query->orWhere('created_at', 'LIKE', '%' . $search['value'] . '%');
                }
            });

        $result->editColumn('active', function (Member $item) {
            $checked = $item->active ? ' checked' : '';
            return '<label class="custom-toggle active-changer">
                    <input type="checkbox" value="'.$item->active.'" '.$checked.'>
                    <span class="custom-toggle-slider rounded-circle"></span>
                </label>';
        });
        $result->editColumn('show_home', function (Member $item) {
            $checked = $item->show_home ? ' checked' : '';
            return '<label class="custom-toggle show-home-changer">
                    <input type="checkbox" value="'.$item->show_home.'" '.$checked.'>
                    <span class="custom-toggle-slider rounded-circle"></span>
                </label>';
        });

        $result->editColumn('title', function (Member $item) {
            return $item->title;
        });

        $result->editColumn('created_at', function (Member $item) {
            return $item->created_at->format('d/m/Y');//->calendar();
        });

        return $result->rawColumns(['active', 'show_home'])->toArray();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;
        $backUrl = route('admin.doctors.index');

        $imageBigSizes = $this->model::$imageBigSizes ?? null;
        $imageBigSize = '';
        if ($imageBigSizes) {
            $imageBigSize = ' (' . $imageBigSizes[0]['width'] . 'x' . $imageBigSizes[0]['height'] . ')';
        }

        $departments = Page::where(['parent_id'=>67, 'active'=>true])->get();
        $MembersCategory = [];

        return response()
            ->view('admin.pages.members.create', compact('edit', 'backUrl', 'imageBigSize','departments','MembersCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMembersRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreMembersRequest $request)
    {

       $item = $this->model->create($request->except('_token', '_method'));

        if (!empty($request['department_ids']))
        {
            $item->createMemberCategory($request['department_ids'], $item->id);
        }
        return redirect()
            ->route('admin.doctors.index');
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

        $edit = true;
        $backUrl = route('admin.doctors.index');

        $imageBigSizes = $this->model::$imageBigSizes ?? null;
        $imageBigSize = '';
        if ($imageBigSizes) {
            $imageBigSize = ' (' . $imageBigSizes[0]['width'] . 'x' . $imageBigSizes[0]['height'] . ')';
        }
        $departments = Page::where(['parent_id'=>67, 'active'=>true])->get();
        $MembersCategory = MembersCategory::where('members_id', $id)->get()->pluck('department_id')->toArray();

        return response()
            ->view('admin.pages.members.edit', compact('edit', 'backUrl', 'imageBigSize', 'item','departments','MembersCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMembersRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateMembersRequest $request, int $id)
    {

        $item = $this->model::findOrFail($id);
        $item->update($request->except('_token', '_method'));
        if (!empty($request['department_ids']))
        {
            $item->createMemberCategory($request['department_ids']);
        }
//        MembersCategory::addOrEdit($id, $request->department_ids);
        return redirect()
            ->route('admin.doctors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteMembersRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteMembersRequest $request, int $id)
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
     * @param ActiveMembersRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function active(ActiveMembersRequest $request, int $id)
    {
        $item = $this->model::findOrFail($id);
        $result = ['success' => false];
        $item->active = $request->value;
        if ($item->save()) {
            $result['success'] = true;
        }

        return response()->json($result);
    }
    public function show_home(ActiveMembersRequest $request, int $id)
    {

        $item = $this->model::findOrFail($id);
        $result = ['success' => false];
        $item->show_home = $request->value;
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
            ->view('admin.pages.members.trash.index', compact('items'));
    }

    /**
     * Restores the specified resource from trash
     *
     * @param RestoreMembersRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(RestoreMembersRequest $request, int $id)
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
     * @param ForceDestroyMembersRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function forceDestroy(ForceDestroyMembersRequest $request, int $id)
    {
        $item = $this->model::withTrashed()->findOrFail($id);
        $result = ['success' => false];
        if ($item->forceDelete()) {
            $result['success'] = true;
        }

        return response()->json($result);
    }
}
