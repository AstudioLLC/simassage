<?php

namespace App\Http\Controllers\Site;

use App\Models\Gallery;
use App\Models\Job;
use App\Models\Member;
use App\Models\News;
use App\Models\Page;
use App\Models\Price;
use App\Models\Service;
use App\Models\Time;
use App\Models\Video;

class JobsController extends BaseController
{
    protected function detail($id)
    {
        $job = Job::find($id);
        return response()
            ->view('site.pages.static.jobSingle', compact('job'));
    }
}
