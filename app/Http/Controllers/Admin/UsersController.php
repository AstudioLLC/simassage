<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Users\ActiveUsersRequest;
use App\Http\Requests\Users\DeleteUsersRequest;
use App\Http\Requests\Users\ForceDestroyUsersRequest;
use App\Http\Requests\Users\RestoreUsersRequest;
use App\Http\Requests\Users\StoreUsersRequest;
use App\Http\Requests\Users\UpdateUsersRequest;
use App\Models\User;
use App\Traits\InteractsWithSortable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends AdminBaseController
{
    use InteractsWithSortable;

    /**
     * @var string
     */
    protected $modelClass = User::class;

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
     * @return Response
     */
    public function index()
    {
        $items = $this->model::sort()
            ->where('type',1)->get();


        return response()
            ->view('admin.pages.users.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $edit = false;
        $backUrl = route('admin.users.index');
        return response()
            ->view('admin.pages.users.create', compact('edit', 'backUrl'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUsersRequest $request
     * @return RedirectResponse
     */
    public function store(StoreUsersRequest $request)
    {
        // Get all the data from the request except for '_token' and '_method'
        $data = $request->except('_token', '_method');

        // Hash the password field if it exists in the request
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        // Create the user with the hashed password
        $this->model->create($data);

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(int $id)
    {
        $item = $this->model::withTrashed()->findOrFail($id);
        $backUrl = route('admin.users.index');

        return response()
            ->view('admin.pages.users.show', compact('id', 'item', 'backUrl'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(int $id)
    {
        $item = $this->model::findOrFail($id);
        $edit = true;
        $backUrl = route('admin.users.index');

        return response()
            ->view('admin.pages.users.edit', compact('item', 'edit', 'backUrl'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUsersRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UpdateUsersRequest $request, int $id)
    {
        $item = $this->model::findOrFail($id);

        // Get all the data from the request except for '_token' and '_method'
        $data = $request->except('_token', '_method');

        // Hash the password field if it exists in the request
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        // Update the user's information
        $item->update($data);

        return redirect()->route('admin.users.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteUsersRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteUsersRequest $request, int $id)
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
     * @param ActiveUsersRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function active(ActiveUsersRequest $request, int $id)
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
            ->view('admin.pages.users.trash.index', compact('items'));
    }

    /**
     * Restores the specified resource from trash
     *
     * @param RestoreUsersRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function restore(RestoreUsersRequest $request, int $id)
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
     * @param ForceDestroyUsersRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function forceDestroy(ForceDestroyUsersRequest $request, int $id)
    {
        $item = $this->model::withTrashed()->findOrFail($id);
        $result = ['success' => false];
        if ($item->forceDelete()) {
            $result['success'] = true;
        }

        return response()->json($result);
    }
}
