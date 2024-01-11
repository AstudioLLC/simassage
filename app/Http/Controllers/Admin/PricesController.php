<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Price\ActivePricesRequest;
use App\Http\Requests\Price\DeletePricesRequest;
use App\Http\Requests\Price\ForceDestroyPricesRequest;
use App\Http\Requests\Price\RestorePricesRequest;
use App\Http\Requests\Price\StorePricesRequest;
use App\Http\Requests\Price\UpdatePricesRequest;
use App\Models\Page;
use App\Models\Price;
use App\Traits\InteractsWithSortable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Yajra\DataTables\Facades\DataTables;

class PricesController extends AdminBaseController
{
    use InteractsWithSortable;

    /**
     * @var string
     */
    protected $modelClass = Price::class;

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
            ->view('admin.pages.prices.index');
    }

    public function listPortion(Request $request)
    {
        //Session::put('sort', $request->get('start') ?? 0);
        $model = $this->model::query()->orderBy('id', 'desc');

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

        $result->editColumn('active', function (Price $item) {
            $checked = $item->active ? ' checked' : '';
            return '<label class="custom-toggle active-changer">
                    <input type="checkbox" value="'.$item->active.'" '.$checked.'>
                    <span class="custom-toggle-slider rounded-circle"></span>
                </label>';
        });

        $result->editColumn('title', function (Price $item) {
            return $item->title;
        });

        $result->editColumn('created_at', function (Price $item) {
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
        $backUrl = route('admin.prices.index');

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
        $allDepartment = Page::where('parent_id', 67)->where(['active'=>true])->get();
        return response()
            ->view('admin.pages.prices.create', compact('edit', 'backUrl', 'imageSmallSize', 'imageBigSize','allDepartment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePricesRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePricesRequest $request)
    {
        $this->model->create($request->except('_token', '_method'));

        return redirect()
            ->route('admin.prices.index');
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
        $backUrl = route('admin.prices.index');

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
        $allDepartment = Page::where('parent_id', 67)->where(['active'=>true])->get();
        return response()
            ->view('admin.pages.prices.edit', compact('edit', 'backUrl', 'imageSmallSize', 'imageBigSize', 'item','allDepartment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePricesRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePricesRequest $request, int $id)
    {

        $item = $this->model::findOrFail($id);
        $item->update($request->except('_token', '_method',
            'title',
            'active',
            'updated_at'));
        merge_model($request->except('_token', '_method'), $item, [
            'title',
            'active',
            'updated_at']);
        $item->save();
//        $item->update($request->except('_token', '_method'));


        return redirect()
            ->route('admin.prices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeletePricesRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeletePricesRequest $request, int $id)
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
     * @param ActivePricesRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function active(ActivePricesRequest $request, int $id)
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
            ->view('admin.pages.prices.trash.index', compact('items'));
    }

    /**
     * Restores the specified resource from trash
     *
     * @param RestorePricesRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(RestorePricesRequest $request, int $id)
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
     * @param ForceDestroyPricesRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function forceDestroy(ForceDestroyPricesRequest $request, int $id)
    {
        $item = $this->model::withTrashed()->findOrFail($id);
        $result = ['success' => false];
        if ($item->forceDelete()) {
            $result['success'] = true;
        }

        return response()->json($result);
    }
}
