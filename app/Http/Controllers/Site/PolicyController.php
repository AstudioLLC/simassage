<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use Illuminate\Http\Request;

class PolicyController extends BaseController
{
    public function download($id){
        $policy = Policy::where('id', $id)->firstOrFail();
        $pathToFile = storage_path('app/file/' . $policy->file);
        return response()->download($pathToFile);
    }
}
