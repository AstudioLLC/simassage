<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Policy\ActivePolicyRequest;
use App\Http\Requests\Policy\DeletePolicyRequest;
use App\Http\Requests\Policy\ForceDestroyPolicyRequest;
use App\Http\Requests\Policy\RestorePolicyRequest;
use App\Http\Requests\Policy\StorePolicyRequest;
use App\Http\Requests\Policy\UpdatePolicyRequest;
use App\Models\Policy;
use App\Traits\InteractsWithSortable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PolicyController extends AdminBaseController
{
    use InteractsWithSortable;

    /**
     * @var string
     */
    protected $modelClass = Policy::class;

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
            ->view('admin.pages.policy.index');
    }

    public function listPortion(Request $request)
    {
        $model = $this->model::query();

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

        $result->editColumn('active', function (Policy $item) {
            $checked = $item->active ? ' checked' : '';
            return '<label class="custom-toggle active-changer">
                    <input type="checkbox" value="'.$item->active.'" '.$checked.'>
                    <span class="custom-toggle-slider rounded-circle"></span>
                </label>';
        });

        $result->editColumn('title', function (Policy $item) {
            return $item->title;
        });

        $result->editColumn('created_at', function (Policy $item) {
            return $item->created_at->format('d/m/Y');//->calendar();
        });

        return $result->rawColumns(['active'])->toArray();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $backUrl = route('admin.policy.index');
        $edit = false;

        $imageSmallSizes = $this->model::$imageSmallSizes ?? null;
        $imageSmallSize = '';
        if ($imageSmallSizes) {
            $imageSmallSize = ' (' . $imageSmallSizes[0]['width'] . 'x' . $imageSmallSizes[0]['height'] . ')';
        }

        return response()
            ->view('admin.pages.policy.create', compact('edit', 'backUrl','imageSmallSize'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePolicyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePolicyRequest $request)
    {
       $item = $this->model->create($request->except('_token', '_method','file',));

        $fileModel  = $item;
        if($request->file()) {
            $fileModel->file = $request->file->getClientOriginalName();
            $request->file->storeAs('file', $fileModel->file);
            $fileModel->save();
        }
        return redirect()
            ->route('admin.policy.index');
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
        $backUrl = route('admin.policy.index');

        $imageSmallSizes = $this->model::$imageSmallSizes ?? null;
        $imageSmallSize = '';
        if ($imageSmallSizes) {
            $imageSmallSize = ' (' . $imageSmallSizes[0]['width'] . 'x' . $imageSmallSizes[0]['height'] . ')';
        }

        return response()
            ->view('admin.pages.policy.edit', compact('edit', 'backUrl', 'item','imageSmallSize'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePolicyRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePolicyRequest $request, int $id)
    {
        $item = $this->model::findOrFail($id);
        $item->update($request->except('_token', '_method','file'));

        $fileModel  = $item;
        if($request->file()) {
            Storage::delete('file/'.$fileModel->file);
            $fileModel->file = $request->file->getClientOriginalName();
            $request->file->storeAs('file', $fileModel->file);

            $fileModel->save();
        }

        return redirect()
            ->route('admin.policy.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeletePolicyRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeletePolicyRequest $request, int $id)
    {
        $item = $this->model::findOrFail($id);
        $result = ['success' => false];
        Storage::delete('file/'.$item->file);
        $item->delete();
        $result['success'] = true;


        return response()->json($result);
    }

    /**
     * Activate/Deactivate the specified resource from storage
     *
     * @param ActivePolicyRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function active(ActivePolicyRequest $request, int $id)
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
            ->view('admin.pages.policy.trash.index', compact('items'));
    }


    public function download($id)
    {
        $policy = Policy::where('id', $id)->firstOrFail();
        $pathToFile = storage_path('app/file/' . $policy->file);
        return response()->download($pathToFile);
    }

    /**
     * Restores the specified resource from trash
     *
     * @param RestorePolicyRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(RestorePolicyRequest $request, int $id)
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
     * @param ForceDestroyPolicyRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function forceDestroy(ForceDestroyPolicyRequest $request, int $id)
    {
        $item = $this->model::withTrashed()->findOrFail($id);
        $result = ['success' => false];
        if ($item->forceDelete()) {
            $result['success'] = true;
        }

        return response()->json($result);
    }
}
