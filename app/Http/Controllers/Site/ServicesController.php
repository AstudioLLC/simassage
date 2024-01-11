<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends BaseController
{
    protected function detail($department, $url)
    {
        $subPage = Page::where(['url' => $department, 'active' => 1])->firstOrFail();
        $service = Service::where(['url' => $url, 'active' => 1])->firstOrFail();
        $gallery = Gallery::where('key', $service->id)->get();
        $this->renderSEO($service);
        $breadcrumbs = $this->renderBreadcrumbs($subPage, $service);
        return response()
            ->view('site.pages.static.serviceSingle', compact( 'service', 'gallery', 'breadcrumbs'));
    }
}
