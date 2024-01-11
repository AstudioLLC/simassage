<?php

namespace App\Http\Controllers\Site;

use App\Models\Gallery;
use App\Models\Member;
use App\Models\News;
use App\Models\Page;
use App\Models\Price;
use App\Models\Service;
use App\Models\Time;
use App\Models\Video;

class MembersController extends BaseController
{
    protected function detail($url)
    {
        $page = Page::where(['static' => 'doctors', 'active' => 1])->firstOrFail();
        $doctor = Member::where(['url' => $url, 'active' => 1])->with('department')->firstOrFail();
        $services = Service::where('active', true)->get();
        $gallery = Gallery::where(['key'=> $doctor->id, 'gallery'=>'members'])->sort()->get();
        $videoGallery = Video::where(['key'=> $doctor->id, 'video'=>'members'])->sort()->get();
        $seo =  $this->renderSEO($doctor);
        $breadcrumbs = $this->renderBreadcrumbs($page, $doctor);
        $time = Time::where('deleted_at',null)->get();
        $departments = Page::whereIn('id',$doctor->department->pluck('department_id')->toArray())->get();
        $departments_ids = $departments->pluck('id')->toArray();
        $allDepartmentsPrice = Price::where(['active' => true])->whereIn('department_id', $departments_ids)->get();

        return response()
            ->view('site.pages.static.doctorsSingle', compact('page', 'doctor', 'breadcrumbs','gallery', 'seo','videoGallery','departments', 'services','time','allDepartmentsPrice'));
    }
}
