<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Question\ActiveQuestionRequest;
use App\Http\Requests\Question\DeleteQuestionRequest;
use App\Http\Requests\Question\ForceDestroyQuestionRequest;
use App\Http\Requests\Question\RestoreQuestionRequest;
use App\Http\Requests\Question\StoreQuestionRequest;
use App\Http\Requests\Question\UpdateQuestionRequest;
use App\Models\Patient;
use App\Models\Question;
use App\Traits\InteractsWithSortable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PatientsController extends AdminBaseController
{
    use InteractsWithSortable;

    /**
     * @var string
     */
    protected $modelClass = Patient::class;

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
            ->view('admin.pages.patients.index');
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

                    $query->orderBy('ordering');
                } else {
                    $query->orderBy('ordering');
                }
            })->filter(function (Builder $query) use ($search) {
                if (!empty($search['value'])) {
                    $query->where('name', 'LIKE', '%' . $search['value'] . '%');
                    $query->orWhere('created_at', 'LIKE', '%' . $search['value'] . '%');
                }
            });

        $result->editColumn('active', function (Patient $item) {
            $checked = $item->active ? ' checked' : '';
            return '<label class="custom-toggle active-changer">
                    <input type="checkbox" value="'.$item->active.'" '.$checked.'>
                    <span class="custom-toggle-slider rounded-circle"></span>
                </label>';
        });

        $result->editColumn('title', function (Patient $item) {
            return $item->title;
        });

        $result->editColumn('created_at', function (Patient $item) {
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
        $backUrl = route('admin.patient.index');
        $edit = false;

        return response()
            ->view('admin.pages.patients.create', compact('edit', 'backUrl'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreQuestionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreQuestionRequest $request)
    {
        $item = $this->model->create($request->except('_token', '_method','file',));

        $fileModel  = $item;
        if($request->file()) {
            $fileModel->file = $request->file->getClientOriginalName();
            $request->file->storeAs('file', $fileModel->file);
            $fileModel->save();
        }
        return redirect()
            ->route('admin.patient.index');
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
        $backUrl = route('admin.patient.index');

        return response()
            ->view('admin.pages.patients.edit', compact('edit', 'backUrl', 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateQuestionRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateQuestionRequest $request, int $id)
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
            ->route('admin.patient.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteQuestionRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteQuestionRequest $request, int $id)
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
     * @param ActiveQuestionRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function active(ActiveQuestionRequest $request, int $id)
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
            ->view('admin.pages.patients.trash.index', compact('items'));
    }


    /**
     * Restores the specified resource from trash
     *
     * @param RestoreQuestionRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(RestoreQuestionRequest $request, int $id)
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
     * @param ForceDestroyQuestionRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function forceDestroy(ForceDestroyQuestionRequest $request, int $id)
    {
        $item = $this->model::withTrashed()->findOrFail($id);
        $result = ['success' => false];
        if ($item->forceDelete()) {
            $result['success'] = true;
        }

        return response()->json($result);
    }
}
