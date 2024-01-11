<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Time\StoreTimeRequest;
use App\Models\Time;
use Illuminate\Http\Request;

class TimeController extends AdminBaseController
{
    protected $modelClass = Time::class;

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
        $items = Time::orderBy('id','desc')->get();

        return response()
        ->view('admin.pages.time.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;
        $backUrl = route('admin.time.index');
        return response()
            ->view('admin.pages.time.create', compact('edit', 'backUrl'));
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTimeRequest $request)
    {
        $this->model->create($request->except('_token', '_method'));
        return redirect()
            ->route('admin.time.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Time  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Time $id)
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
        $backUrl = route('admin.time.index');
        return response()
        ->view('admin.pages.time.edit', compact('item', 'edit', 'backUrl'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTimeRequest $request, int $id)
    {
        $item = $this->model::findOrFail($id);
        $item->update($request->except('_token', '_method'));

        return redirect()
            ->route('admin.time.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, int $id)
    {
        $item = $this->model::findOrFail($id);
        $result = ['success' => false];
        if ($item->delete()) {
            $result['success'] = true;
        }

        return response()->json($result);
    }
}
