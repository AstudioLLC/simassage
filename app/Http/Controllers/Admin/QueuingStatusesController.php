<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\QueuingStatus\StoreQueuingStatusRequest;
use App\Http\Requests\QueuingStatus\UpdateQueuingStatusRequest;
use App\Models\QueuingStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QueuingStatusesController extends AdminBaseController
{
    protected $modelClass = QueuingStatus::class;

     /**
     * @var mixed
     */
    protected $model;

    public function __construct()
    {
        parent::__construct();

        $this->model = new $this->modelClass;
    }



    public function index(): Response
    {
        $items = QueuingStatus::orderBy('id','desc')->get();

        return response()
        ->view('admin.pages.queuing_statuses.index', compact('items'));
    }


    public function create(): Response
    {
        $edit = false;
        $backUrl = route('admin.queuing_statuses.index');
        return response()
            ->view('admin.pages.queuing_statuses.create', compact('edit', 'backUrl'));
        }


    public function store(StoreQueuingStatusRequest $request): RedirectResponse
    {
        $this->model->create($request->except('_token', '_method'));
        return redirect()
            ->route('admin.queuing_statuses.index');
    }


    public function show(int $id)
    {
        dd($id);
    }


    public function edit(int $id): Response
    {
        $item = $this->model::findOrFail($id);
        $edit = true;
        $backUrl = route('admin.queuing_statuses.index');
        return response()
        ->view('admin.pages.queuing_statuses.edit', compact('item', 'edit', 'backUrl'));
    }


    public function update(UpdateQueuingStatusRequest $request, int $id): RedirectResponse
    {
        $item = $this->model::findOrFail($id);
        $item->update($request->except('_token', '_method'));

        return redirect()
            ->route('admin.queuing_statuses.index');
    }


    public function destroy(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        $item = $this->model::findOrFail($id);
        $result = ['success' => false];
        if ($item->delete()) {
            $result['success'] = true;
        }

        return response()->json($result);
    }
}
