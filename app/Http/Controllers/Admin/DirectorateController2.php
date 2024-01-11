<?php

namespace App\Http\Controllers\Admin;



use App\Http\Requests\Directorate2\DeleteDirectoratesRequest;
use App\Http\Requests\Directorate2\StoreDirectorateRequest;
use App\Http\Requests\Directorate2\UpdateDirectorateRequest;
use App\Models\Administrator;
use App\Traits\InteractsWithSortable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class DirectorateController2 extends AdminBaseController
{
    use InteractsWithSortable;

    /**
     * @var string
     */
    protected $modelClass = Administrator::class;

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
            ->view('admin.pages.directorate2.index');
    }

    public function listPortion(Request $request)
    {
        $model = $this->model::query()->sort();

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

        $result->editColumn('active', function ( $item) {
            $checked = $item->active ? ' checked' : '';
            return '<label class="custom-toggle active-changer">
                    <input type="checkbox" value="'.$item->active.'" '.$checked.'>
                    <span class="custom-toggle-slider rounded-circle"></span>
                </label>';
        });

        $result->editColumn('name', function (Administrator $item) {
            return $item->name;
        });

        $result->editColumn('created_at', function (Administrator $item) {
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
        $edit = false;
        $backUrl = route('admin.directorate2.index');

        $imageBigSizes = $this->model::$image ?? null;
        $imageBigSize = '';
        if ($imageBigSizes) {
            $imageBigSize = ' (' . $imageBigSizes[0]['width'] . 'x' . $imageBigSizes[0]['height'] . ')';
        }

        return response()
            ->view('admin.pages.directorate2.create', compact('edit', 'backUrl', 'imageBigSize',));
    }


    public function store(StoreDirectorateRequest $request)
    {
        $this->model->create($request->except('_token', '_method'));

        return response()
            ->view('admin.pages.directorate2.index');
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
        $backUrl = route('admin.directorate2.index');

        $imageBigSizes = $this->model::$imageBigSizes ?? null;
        $imageBigSize = '';
        if ($imageBigSizes) {
            $imageBigSize = ' (' . $imageBigSizes[0]['width'] . 'x' . $imageBigSizes[0]['height'] . ')';
        }

        return response()
            ->view('admin.pages.directorate2.edit', compact('edit', 'backUrl', 'imageBigSize', 'item'));
    }


    public function update(UpdateDirectorateRequest $request, int $id)
    {

        $item = $this->model::findOrFail($id);
        $item->update($request->except('_token', '_method'));

        return redirect()
            ->route('admin.directorate2.index');
    }


    public function destroy(DeleteDirectoratesRequest $request, int $id)
    {

        $item = $this->model::findOrFail($id);
        $result = ['success' => false];
        $item->delete();
        $result['success'] = true;

        return response()->json($result);
    }


    public function active(Request $request, int $id)
    {
        $item = $this->model::findOrFail($id);
        $result = ['success' => false];
        $item->active = $request->value;
        if ($item->save()) {
            $result['success'] = true;
        }

        return response()->json($result);
    }

    public function deleteImage(Request $request)
    {
        // Get the image filename from the request
        $item = $this->model->find($request->item_id);
        $filename = $item->image;

        // Delete the image file from storage
        if ($filename) {
            Storage::delete($filename);
            // Set the image column value to null
            $item->image = null;
            $item->save();
        }
    }
}
