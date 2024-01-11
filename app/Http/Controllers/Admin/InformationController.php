<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Information\UpdateInformationRequest;
use App\Http\Requests\Information\UpdateNotificationTextRequest;
use App\Models\Information;
use App\Traits\InteractsWithSortable;
use Illuminate\Http\Request;

class InformationController extends AdminBaseController
{
    use InteractsWithSortable;

    /**
     * @var string
     */
    protected $modelClass = Information::class;

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
        abort(404);
        $items = $this->model::sort()
            ->get();

        return response()
            ->view('admin.pages.information.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort(404);
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

        return response()
            ->view('admin.pages.information.edit', compact('edit', 'backUrl', 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateInformationRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateInformationRequest $request, int $id)
    {
        $item = $this->model::findOrFail($id);
        $item->update($request->except('_token', '_method'));

        return redirect()
            ->route('admin.information.edit', ['id' => 1]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        abort(404);
    }
}
