<?php

namespace App\Http\Controllers\Site;

use App\Models\Administrator;
use App\Models\Directorate;
use App\Models\Page;
use App\Models\Service;
use App\Models\Time;

class DirectoratesController2 extends BaseController
{
    protected function detail($url)
    {
        $page = Page::where(['static' => 'administration', 'active' => 1])->firstOrFail();
        $directorate = Administrator::where(['url' => $url, 'active' => 1])->firstOrFail();
        $seo = $this->renderSEO($directorate);
        $breadcrumbs = $this->renderBreadcrumbs($page, $directorate);

        $time = Time::where('deleted_at',null)->get();
        return response()
            ->view('site.pages.static.administrationSingle', compact('page', 'directorate', 'breadcrumbs', 'seo', 'time'));
    }
}
