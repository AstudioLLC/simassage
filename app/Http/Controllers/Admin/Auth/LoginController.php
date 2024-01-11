<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Auth\LoginController as BaseLoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseLoginController
{
    protected $viewsNamespace = 'admin';

    protected $redirectTo = null;

    public function __construct()
    {

        parent::__construct();

        $this->redirectTo = route(env('CMS_HOMEPAGE_ROUTE'));
    }

    /*public function logout(Request $request)
    {
        if ($request->input('action') == 'logout') {
            Auth::logout();
            $request->session()->flush();

            return redirect()->route('admin.login');
        }

        return redirect()->$this->redirectTo;
    }*/
}
