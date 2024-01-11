<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\News\ActiveNewsRequest;
use App\Http\Requests\News\DeleteNewsRequest;
use App\Http\Requests\News\ForceDestroyNewsRequest;
use App\Http\Requests\News\RestoreNewsRequest;
use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;
use App\Models\News;
use App\Traits\InteractsWithSortable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class NewsController extends AdminBaseController
{
    use InteractsWithSortable;

    /**
     * @var string
     */
    protected $modelClass = News::class;

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
            ->view('admin.pages.news.index');
    }

    public function listPortion(Request $request)
    {
        //Session::put('sort', $request->get('start') ?? 0);
        $model = $this->model::query()->withCount(['gallery'])->withCount(['videos']);

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

        $result->editColumn('active', function (News $item) {
            $checked = $item->active ? ' checked' : '';
            return '<label class="custom-toggle active-changer">
                    <input type="checkbox" value="'.$item->active.'" '.$checked.'>
                    <span class="custom-toggle-slider rounded-circle"></span>
                </label>';
        });

        $result->editColumn('title', function (News $item) {
            return $item->title;
        });

        $result->editColumn('created_at', function (News $item) {
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
        $backUrl = route('admin.news.index');

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
            ->view('admin.pages.news.create', compact('edit', 'backUrl', 'imageSmallSize', 'imageBigSize'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNewsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreNewsRequest $request)
    {
        $this->model->create($request->except('_token', '_method'));

        return redirect()
            ->route('admin.news.index');
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
        $backUrl = route('admin.news.index');

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
            ->view('admin.pages.news.edit', compact('edit', 'backUrl', 'imageSmallSize', 'imageBigSize', 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateNewsRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateNewsRequest $request, int $id)
    {

        $item = $this->model::findOrFail($id);
        // dd($request->all());
        $item->update($request->except('_token', '_method',
            'title',
            'url',
            'active',
            'short',
            'content',
            'seo_title',
            'seo_description',
            'seo_keywords',
            'created_at',
            'updated_at'));
        merge_model($request->except('_token', '_method'), $item, [
            'title',
            'url',
            'active',
            'short',
            'content',
            'seo_title',
            'seo_description',
            'seo_keywords',
            'created_at',
            'updated_at']);
        $item->save();
//        $item->update($request->except('_token', '_method'));


        return redirect()
            ->route('admin.news.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteNewsRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteNewsRequest $request, int $id)
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
     * @param ActiveNewsRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function active(ActiveNewsRequest $request, int $id)
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
            ->view('admin.pages.news.trash.index', compact('items'));
    }

    /**
     * Restores the specified resource from trash
     *
     * @param RestoreNewsRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(RestoreNewsRequest $request, int $id)
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
     * @param ForceDestroyNewsRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function forceDestroy(ForceDestroyNewsRequest $request, int $id)
    {
        $item = $this->model::withTrashed()->findOrFail($id);
        $result = ['success' => false];
        if ($item->forceDelete()) {
            $result['success'] = true;
        }

        return response()->json($result);
    }

    public function deleteImageBig(Request $request)
    {
        // Get the image filename from the request
        $item = $this->model->find($request->item_id);
        $filename = $item->imageBig;

        // Delete the image file from storage
        if ($filename) {
            Storage::delete($filename);
            // Set the image column value to null
            $item->imageBig = null;
            $item->save();
        }

    }

    public function deleteImageSmall(Request $request)
    {
        // Get the image filename from the request
        $item = $this->model->find($request->item_id);

        $filename = $item->imageSmall;

        // Delete the image file from storage
        if ($filename) {
            Storage::delete($filename);
            // Set the image column value to null
            $item->imageSmall = null;
            $item->save();
        }

    }


    public function deleteImageSmallSecond(Request $request)
    {
        // Get the image filename from the request
        $item = $this->model->find($request->item_id);

        $filename = $item->imageSmallSecond	;

        // Delete the image file from storage
        if ($filename) {
            Storage::delete($filename);
            // Set the image column value to null
            $item->imageSmallSecond	 = null;
            $item->save();

        }

    }

}
