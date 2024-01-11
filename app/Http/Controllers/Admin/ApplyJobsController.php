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
use App\Models\JobApply;
use App\Traits\InteractsWithSortable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ApplyJobsController extends AdminBaseController
{
    use InteractsWithSortable;

    /**
     * @var string
     */
    protected $modelClass = JobApply::class;

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
            ->view('admin.pages.applyJobs.index');
    }

    public function listPortion(Request $request)
    {
        $model = $this->model::query()->orderBy('id', 'desc');
        $search = $request->input('search');
        $result = DataTables::eloquent($model)
            ->order(function (Builder $query) use ($request) {
                if ($request->has('order')) {
                    $order = Arr::first($request->input('order'));
                    $orderColumn = $request->input("columns.{$order['column']}.data");
                    $orderDir = $order['dir'];

                    $query->orderBy('id');
                } else {
                    $query->orderBy('id', 'desc');
                }
            })->filter(function (Builder $query) use ($search) {
                if (!empty($search['value'])) {
                    $query->where('name', 'LIKE', '%' . $search['value'] . '%');
                    $query->orWhere('created_at', 'LIKE', '%' . $search['value'] . '%');
                }
            });


        $result->editColumn('name', function (JobApply $item) {
            return $item->name;
        });

        $result->editColumn('created_at', function (JobApply $item) {
            return $item->created_at->format('d/m/Y');//->calendar();
        });

        return $result->toArray();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $item = $this->model::findOrFail($id);
        JobApply::where('id',$id)->where('seen','0')->update(['seen'=>1]);

        return response()
            ->view('admin.pages.applyJobs.show',compact('item'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteJobRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, int $id)
    {   
        $item = $this->model::findOrFail($id);
        $result = ['success' => false];
        Storage::delete('file/thumbnail/'.$item->file); if (Storage::exists('file/thumbnail/' . $item->file)) {
            Storage::delete('file/thumbnail/' . $item->file);
        }
        $item->delete();
        $result['success'] = true;
    
        return response()->json($result);
    }

    public function download($id)
    {
        $jobApply = JobApply::findOrFail($id);
        $filePath = storage_path('app/file/thumbnail/' . $jobApply->file);

        if (Storage::exists('file/thumbnail/' . $jobApply->file)) {
            return response()->file($filePath);
        } else {
            abort(404, 'File not found');
        }
    }

}
