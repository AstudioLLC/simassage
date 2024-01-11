<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Social\ActiveSocialRequest;
use App\Http\Requests\Social\DeleteSocialRequest;
use App\Http\Requests\Social\ForceDestroySocialRequest;
use App\Http\Requests\Social\RestoreSocialRequest;
use App\Http\Requests\Social\StoreSocialRequest;
use App\Http\Requests\Social\UpdateSocialRequest;
use App\Models\Social;
use App\Traits\InteractsWithSortable;

class SocialsController extends AdminBaseController
{
    use InteractsWithSortable;

    /**
     * @var string
     */
    protected $modelClass = Social::class;

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
            ->view('admin.pages.socials.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;
        $backUrl = route('admin.socials.index');
        $imageSizes = $this->model::$imageSizes ?? null;
        $imageSize = '';
        if ($imageSizes) {
            $imageSize = ' (' . $imageSizes[0]['width'] . 'x' . $imageSizes[0]['height'] . ')';
        }

        return response()
            ->view('admin.pages.socials.create', compact('edit', 'backUrl', 'imageSize'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSocialRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSocialRequest $request)
    {
        $this->model->create($request->except('_token', '_method'));
        return redirect()
            ->route('admin.socials.index');
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
        $backUrl = route('admin.socials.index');

        $imageSizes = $this->model::$imageSizes ?? null;
        $imageSize = '';
        if ($imageSizes) {
            $imageSize = ' (' . $imageSizes[0]['width'] . 'x' . $imageSizes[0]['height'] . ')';
        }

        return response()
            ->view('admin.pages.socials.edit', compact('item', 'edit', 'backUrl', 'imageSize'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSocialRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSocialRequest $request, int $id)
    {
        $item = $this->model::findOrFail($id);
        $item->update($request->except('_token', '_method'));
        return redirect()
            ->route('admin.socials.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteSocialRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteSocialRequest $request, int $id)
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
     * @param ActiveSocialRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function active(ActiveSocialRequest $request, int $id)
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
            ->view('admin.pages.socials.trash.index', compact('items'));
    }

    /**
     * Restores the specified resource from trash
     *
     * @param RestoreSocialRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(RestoreSocialRequest $request, int $id)
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
     * @param ForceDestroySocialRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function forceDestroy(ForceDestroySocialRequest $request, int $id)
    {
        $item = $this->model::withTrashed()->findOrFail($id);
        $result = ['success' => false];
        if ($item->forceDelete()) {
            $result['success'] = true;
        }

        return response()->json($result);
    }
}
