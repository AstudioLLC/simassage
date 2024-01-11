<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Message\UpdateStatusRequest;
use App\Http\Requests\QueuingMessages\DeleteMessageRequest;
use App\Http\Requests\QueuingMessages\StoreMessageRequest;
use App\Http\Requests\QueuingMessages\UpdateMessageRequest;
use App\Models\QueuingMessage;
use App\Models\QueuingStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class QueuingMessagesController extends AdminBaseController
{
    /**
     * @var string
     */
    protected $modelClass = QueuingMessage::class;

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

        $statusData = QueuingStatus::all();

        return response()
            ->view('admin.pages.queuingMessages.index',compact('statusData'));
    }

    public function listPortion(Request $request)
    {
        //Session::put('sort', $request->get('start') ?? 0);
        $model = $this->model::query();

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
                    $query->orWhere('email', 'LIKE', '%' . $search['value'] . '%');
                    $query->orWhere('message', 'LIKE', '%' . $search['value'] . '%');
                    $query->orWhere('created_at', 'LIKE', '%' . $search['value'] . '%');
                }
            });

        $result->editColumn('created_at', function (QueuingMessage $item) {
            return $item->created_at->format('d/m/Y');//->calendar();
        });

        return $result->toArray();
    }


    public function  listStatus () {
        $status =  QueuingStatus::all();
        return response()->json($status);
    }

    public function  updateStatus (UpdateStatusRequest $request) {

        $item = $this->model::findOrFail($request->id);
        $item->update([
            'status_id' => $request->status_id
        ]);
        return response()->json($item);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;
        $backUrl = route('admin.queuing_message.index');

        return response()
            ->view('admin.pages.queuingMessages.create', compact('edit', 'backUrl'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMessageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreMessageRequest $request)
    {

        $this->model->create($request->except('_token', '_method'));

        return redirect()
            ->route('admin.queuing_message.index');
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
    public function edit($id)
    {
        QueuingMessage::where('id',$id)->where('seen','0')->update(['seen'=>1]);
        $item = $this->model::findOrFail($id);

        $edit = true;
        $backUrl = route('admin.queuing_message.index');

        return response()
            ->view('admin.pages.queuingMessages.edit', compact('edit', 'backUrl', 'item',));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMessageRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateMessageRequest $request, int $id)
    {
        $item = $this->model::findOrFail($id);

        $item->update($request->except('_token', '_method'));


        return redirect()
            ->route('admin.queuing_message.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteMessageRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteMessageRequest $request, int $id)
    {
        $item = $this->model::findOrFail($id);
        $result = ['success' => false];
        $item->delete();
        $result['success'] = true;

        return response()->json($result);
    }


}
