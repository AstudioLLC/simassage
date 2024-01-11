<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Gift\ActiveGiftRequest;
use App\Http\Requests\Gift\DeleteGiftRequest;
use App\Http\Requests\Gift\StoreGiftRequest;
use App\Http\Requests\Gift\UpdateGiftRequest;
use App\Models\Gift;
use App\Traits\InteractsWithSortable;

class AdvantagesController extends AdminBaseController
{
    use InteractsWithSortable;

    /**
     * @var string
     */
    protected $modelClass = Gift::class;

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
            ->view('admin.pages.advantages.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;
        $backUrl = route('admin.advantages.index');

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
            ->view('admin.pages.advantages.create', compact('edit', 'backUrl', 'imageSmallSize', 'imageBigSize'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGiftRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreGiftRequest $request)
    {
        $this->model->create($request->except('_token', '_method'));
        return redirect()
            ->route('admin.advantages.index');
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
        $backUrl = route('admin.advantages.index');

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
            ->view('admin.pages.advantages.edit', compact('edit', 'backUrl', 'imageSmallSize', 'imageBigSize', 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateGiftRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateGiftRequest $request, int $id)
    {
        $item = $this->model::findOrFail($id);
        $item->update($request->except('_token', '_method'));

        return redirect()
            ->route('admin.advantages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteGiftRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteGiftRequest $request, int $id)
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
     * @param ActiveGiftRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function active(ActiveGiftRequest $request, int $id)
    {
        $item = $this->model::findOrFail($id);
        $result = ['success' => false];
        $item->active = $request->value;
        if ($item->save()) {
            $result['success'] = true;
        }

        return response()->json($result);
    }
}
