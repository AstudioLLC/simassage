<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends AdminBaseController
{
    public function index()
    {
        /*$service_url = 'https://donate.gotest.site/api/crm';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $service_url);
        $headers = [
            'auth: crm@donate.am',
            'password: 7K0q5Q3e',
        ];
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($curl);
        curl_close($curl);

        print $response;
        dd(1);*/

        return view('admin.pages.dashboard.index');
    }
}
