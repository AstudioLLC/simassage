<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Slider\ActiveSliderRequest;
use App\Http\Requests\Slider\DeleteSliderRequest;
use App\Http\Requests\Slider\ForceDestroySliderRequest;
use App\Http\Requests\Slider\RestoreSliderRequest;
use App\Http\Requests\Slider\StoreSliderRequest;
use App\Http\Requests\Slider\UpdateSliderRequest;
use App\Models\Slider;
use App\Traits\InteractsWithSortable;
use Illuminate\Support\Facades\DB;

class SlidersController extends AdminBaseController
{
    use InteractsWithSortable;

    /**
     * @var string
     */
    protected $modelClass = Slider::class;

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
        $items = $this->model::sort()
            ->get();

        return response()
            ->view('admin.pages.sliders.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;
        $backUrl = route('admin.sliders.index');
        $imageSizes = $this->model::$imageSizes ?? null;
        $imageSize = '';
        if ($imageSizes) {
            $imageSize = ' (' . $imageSizes[0]['width'] . 'x' . $imageSizes[0]['height'] . ')';
        }

        return response()
            ->view('admin.pages.sliders.create', compact('edit', 'backUrl', 'imageSize'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSliderRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSliderRequest $request)
    {
        $this->model->create($request->except('_token', '_method'));
        return redirect()
            ->route('admin.sliders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $item = $this->model::withTrashed()->findOrFail($id);
        $backUrl = route('admin.sliders.index');

        return response()
            ->view('admin.pages.sliders.show', compact('id', 'item', 'backUrl'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $item = $this->model::findOrFail($id);
        $edit = true;
        $backUrl = route('admin.sliders.index');

        $imageSizes = $this->model::$imageSizes ?? null;
        $imageSize = '';
        if ($imageSizes) {
            $imageSize = ' (' . $imageSizes[0]['width'] . 'x' . $imageSizes[0]['height'] . ')';
        }

        return response()
            ->view('admin.pages.sliders.edit', compact('item', 'edit', 'backUrl', 'imageSize'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSliderRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSliderRequest $request, int $id)
    {

         $item = $this->model::findOrFail($id);

         $item->update($request->except('_token', '_method'));

         $title = [];
         $languages = ['hy', 'ru', 'en'];
         $url = $request->url;

         foreach ($languages as $lang) {
             $title[$lang] = $request->input('title.'.$lang, '');
         }
         // Execute a raw SQL update statement to set the title
         DB::table('sliders')->where('id', $id)->update(['title' => json_encode($title),'url' => $url]);

        return redirect()->route('admin.sliders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteSliderRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteSliderRequest $request, int $id)
    {
        $item = $this->model::findOrFail($id);
        $result = ['success' => false];
        if ($item->delete()) {
            $result['success'] = true;
        }

        return response()->json($result);
    }

    /**
     * Activate/Deactivate the specified resource from storage
     *
     * @param ActiveSliderRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function active(ActiveSliderRequest $request, int $id)
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
     * @return \Illuminate\Http\Response
     */
    public function onlyTrashed()
    {
        $items = $this->model::onlyTrashed()->sort()->get();

        return response()
            ->view('admin.pages.sliders.trash.index', compact('items'));
    }

    /**
     * Restores the specified resource from trash
     *
     * @param RestoreSliderRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(RestoreSliderRequest $request, int $id)
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
     * @param ForceDestroySliderRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function forceDestroy(ForceDestroySliderRequest $request, int $id)
    {
        $item = $this->model::withTrashed()->findOrFail($id);
        $result = ['success' => false];
        if ($item->forceDelete()) {
            $result['success'] = true;
        }

        return response()->json($result);
    }
}
