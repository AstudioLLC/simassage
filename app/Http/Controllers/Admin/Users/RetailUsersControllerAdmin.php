<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Constants\UserRole;
use App\Constants\UserType;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class RetailUsersControllerAdmin extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = t('Admin header.Site users') . '*- Розничная*';

        return view('admin.pages.users.retail.index', compact('title'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return array
     */
    public function listPortion(Request $request)
    {
        Session::put('sort', $request->get('start') ?? 0);
        $model = User::query()
            ->where('role', UserRole::USER)
            ->where('type', UserType::RETAIL)
            ->with('orders');

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

        $result->editColumn('active', function (User $item) {
            return $item->active ? t('Admin pages list.active') : t('Admin pages list.inactive');
        });
        $result->editColumn('ordersCount', function (User $item) {
            return count($item->orders);
        });
        $result->editColumn('created_at', function (User $item) {
            return $item->created_at->format('d.m.Y');//->calendar();
        });

        return $result->toArray();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
