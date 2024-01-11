<?php

namespace App\Http\Controllers\Site\Auth;

use App\Http\Controllers\Site\BaseController;
use App\Http\Controllers\Auth\LoginController as BaseLoginController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use SoapClient;

class LoginController extends BaseController
{
    use AuthenticatesUsers;

    protected $viewsNamespace = 'site';

    protected $redirectTo = null;

    public function __construct()
    {
        parent::__construct();

        $this->redirectTo = route('cabinet.home.index');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return redirect('/');
        $this->staticSEO('test');

        $breadcrumbs = [
            [
                'title' => __('frontend.Login'),
                'url' => ''
            ]
        ];

        return response()
            ->view(($this->viewsNamespace ? "$this->viewsNamespace." : '') . 'pages.auth.login', compact('breadcrumbs'));
    }

}
