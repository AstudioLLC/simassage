<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Library;
use Illuminate\Http\Request;

class LibraryController extends BaseController
{
    public function download($id){
        $policy = Library::where('id', $id)->firstOrFail();
        $pathToFile = storage_path('app/file/' . $policy->file);
        return response()->download($pathToFile);
    }
}
