<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Job\ActiveJobRequest;
use App\Http\Requests\Job\DeleteJobRequest;
use App\Http\Requests\Job\ForceDestroyJobRequest;
use App\Http\Requests\Job\RestoreJobRequest;
use App\Http\Requests\Job\StoreJobRequest;
use App\Http\Requests\Job\UpdateJobRequest;
use App\Models\Job;
use App\Traits\InteractsWithSortable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class JobsController extends AdminBaseController
{
    use InteractsWithSortable;

    /**
     * @var string
     */
    protected $modelClass = Job::class;

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
            ->view('admin.pages.jobs.index');
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
                    $query->where('title', 'LIKE', '%' . $search['value'] . '%');
                    $query->orWhere('created_at', 'LIKE', '%' . $search['value'] . '%');
                }
            });

        $result->editColumn('active', function (Job $item) {
            $checked = $item->active ? ' checked' : '';
            return '<label class="custom-toggle active-changer">
                    <input type="checkbox" value="'.$item->active.'" '.$checked.'>
                    <span class="custom-toggle-slider rounded-circle"></span>
                </label>';
        });

        $result->editColumn('title', function (Job $item) {
            return $item->title;
        });

        $result->editColumn('created_at', function (Job $item) {
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
        $backUrl = route('admin.job.index');
        $edit = false;

        return response()
            ->view('admin.pages.jobs.create', compact('edit', 'backUrl'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreJobRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreJobRequest $request)
    {
        $item = $this->model->create($request->except('_token', '_method','file',));
        if ($item->created_at == null){
            $item->created_at = Carbon::now();
            $item->save();
        }
        $fileModel  = $item;
        if($request->file()) {
            $fileModel->file = $request->file->getClientOriginalName();
            $request->file->storeAs('file', $fileModel->file);
            $fileModel->save();
        }
        return redirect()
            ->route('admin.job.index');
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
        $backUrl = route('admin.job.index');

        return response()
            ->view('admin.pages.jobs.edit', compact('edit', 'backUrl', 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateJobRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateJobRequest $request, int $id)
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
            ->route('admin.job.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteJobRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteJobRequest $request, int $id)
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
     * @param ActiveJobRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function active(ActiveJobRequest $request, int $id)
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
            ->view('admin.pages.jobs.trash.index', compact('items'));
    }


    public function download($id)
    {
        $library = Job::where('id', $id)->firstOrFail();
        $pathToFile = storage_path('app/file/' . $library->file);
        return response()->download($pathToFile);
    }

    /**
     * Restores the specified resource from trash
     *
     * @param RestoreJobRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(RestoreJobRequest $request, int $id)
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
     * @param ForceDestroyJobRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function forceDestroy(ForceDestroyJobRequest $request, int $id)
    {
        $item = $this->model::withTrashed()->findOrFail($id);
        $result = ['success' => false];
        if ($item->forceDelete()) {
            $result['success'] = true;
        }

        return response()->json($result);
    }
}
