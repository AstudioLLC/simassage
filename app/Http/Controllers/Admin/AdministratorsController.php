<?php

namespace App\Http\Controllers\Admin;

use App\Constants\UserRole;
use App\Http\Requests\Administrators\ActiveAdministratorRequest;
use App\Http\Requests\Administrators\DeleteAdministratorRequest;
use App\Http\Requests\Administrators\StoreAdministratorRequest;
use App\Http\Requests\Administrators\UpdateAdministratorRequest;
use App\Models\Administrator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AdministratorsController extends AdminBaseController
{
    /**
     * @var string
     */
    protected $modelClass = Administrator::class;

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
            ->view('admin.pages.administrators.index');
    }

    public function listPortion(Request $request)
    {
        //Session::put('sort', $request->get('start') ?? 0);
        $model = $this->model::query()
            ->where('role', '<=', UserRole::SYSTEMADMIN);

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
                    $query->orWhere('created_at', 'LIKE', '%' . $search['value'] . '%');
                }
            });

        $result->editColumn('role', function (Administrator $item) {
            return $item->getRoleText($item->role);
        });

        $result->editColumn('active', function (Administrator $item) {
            $checked = $item->active ? ' checked' : '';
            return '<label class="custom-toggle active-changer">
                    <input type="checkbox" value="'.$item->active.'" '.$checked.'>
                    <span class="custom-toggle-slider rounded-circle"></span>
                </label>';
        });

        $result->editColumn('created_at', function (Administrator $item) {
            return $item->created_at->format('d/m/Y');//->calendar();
        });

        return $result->rawColumns(['active', 'role'])->toArray();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws \ReflectionException
     */
    public function create()
    {
        $edit = false;
        $backUrl = route('admin.administrators.index');

        $roles = UserRole::keys();
        foreach ($roles as $key => $role) {
            $roles[$key] = $this->model->getRoleText($key);
            if ($key > 5) {
                unset($roles[$key]);
            }
        }

        return response()
            ->view('admin.pages.administrators.create', compact('edit', 'backUrl', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAdministratorRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreAdministratorRequest $request)
    {
        $request->merge([
            'password' => Hash::make($request->get('password'))
        ]);
        $this->model->create($request->except('_token', '_method'));

        return redirect()
            ->route('admin.administrators.index');
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
        $roles = UserRole::keys();
        foreach ($roles as $key => $role) {
            $roles[$key] = $this->model->getRoleText($key);
            if ($key > 5) {
                unset($roles[$key]);
            }
        }

        $edit = true;
        $backUrl = route('admin.administrators.index');

        return response()
            ->view('admin.pages.administrators.edit', compact('edit', 'backUrl', 'roles', 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAdministratorRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAdministratorRequest $request, int $id)
    {
        $item = $this->model::findOrFail($id);
        $item->update($request->except('_token', '_method'));

        return redirect()
            ->route('admin.administrators.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteAdministratorRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteAdministratorRequest $request, $id)
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
     * @param ActiveAdministratorRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function active(ActiveAdministratorRequest $request, $id)
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
