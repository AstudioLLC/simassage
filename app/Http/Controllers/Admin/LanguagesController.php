<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Language\DeleteLanguageRequest;
use App\Http\Requests\Language\StoreLanguageRequest;
use App\Http\Requests\Language\UpdateLanguageRequest;
use App\Models\Language;
use App\Traits\InteractsWithSortable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LanguagesController extends AdminBaseController
{
    use InteractsWithSortable;

    /**
     * @var string
     */
    protected $modelClass = Language::class;

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
        $items = $this->model::sort()->get();

        return response()
            ->view('admin.pages.languages.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;
        $backUrl = route('admin.languages.index');

        return response()
            ->view('admin.pages.languages.create', compact('edit', 'backUrl'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreLanguageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreLanguageRequest $request)
    {
        $this->model->create($request->except('_token', '_method'));

        return redirect()
            ->route('admin.languages.index');
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
        $backUrl = route('admin.languages.index');

        return response()
            ->view('admin.pages.languages.edit', compact('item', 'edit', 'backUrl'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateLanguageRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateLanguageRequest $request, int $id)
    {
        $item = $this->model::findOrFail($id);
        $item->update($request->except('_token', '_method'));

        return redirect()
            ->route('admin.languages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteLanguageRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteLanguageRequest $request, int $id)
    {
        $item = $this->model::findOrFail($id);
        $result = ['success' => false];
        if ($item->default != 1 || $item->admin != 1 || $item->url != 1) {
            if ($item->delete()) {
                $result['success'] = true;
            }
        }

        return response()->json($result);
    }

    /**
     * @param Request $request
     * @param $id
     * @return Response|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function active(Request $request, $id)
    {
        if (!$id) {
            return response()->make('Failed', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $item = $this->model::where('id', $request->item_id)->first();
        if (!$item) {
            return response()->make('Failed', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $item->active = $request->value;
        if (!$item->save()) {
            return response()->make('Failed', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->make('Success', Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @param $id
     * @return Response|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function admin(Request $request, $id)
    {
        if (!$id) {
            return response()->make('Failed', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $item = $this->model::where('id', $request->item_id)->first();
        if (!$item) {
            return response()->make('Failed', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if ($request->value == 1) {
            $this->model::where('admin', 1)->update(['admin' => 0]);
            $this->model::where('id', $id)->update(['admin' => 1]);
        }

        return response()->make('Success', Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @param $id
     * @return Response|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function default(Request $request, $id)
    {
        if (!$id) {
            return response()->make('Failed', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $item = $this->model::where('id', $request->item_id)->first();
        if (!$item) {
            return response()->make('Failed', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if ($request->value == 1) {
            $this->model::where('default', 1)->update(['default' => 0]);
            $this->model::where('id', $id)->update(['default' => 1]);
        }

        return response()->make('Success', Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @param $id
     * @return Response|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function url(Request $request, $id)
    {
        if (!$id) {
            return response()->make('Failed', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $item = $this->model::where('id', $request->item_id)->first();
        if (!$item) {
            return response()->make('Failed', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if ($request->value == 1) {
            $this->model::where('url', 1)->update(['url' => 0]);
            $this->model::where('id', $id)->update(['url' => 1]);
        }

        return response()->make('Success', Response::HTTP_OK);
    }
}
