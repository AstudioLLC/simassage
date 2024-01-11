<?php

namespace App\Http\Controllers\Site;

use App\Models\Gallery;
use App\Models\News;
use App\Models\Page;
use App\Models\Video;

class PatientsController extends BaseController
{
    protected function detail($url)
    {
        $page = Page::where(['static' => 'patient', 'active' => 1])->firstOrFail();
  
        $item = Page::where(['url' => $url, 'active' => 1])->first();
       
        $gallery = Gallery::where('key', $item->id)->sort()->get();
        $videoGallery = Video::where('key', $item->id)->sort()->get();
        $seo = $this->renderSEO($page);

        $this->renderSEO($item);
        $breadcrumbs = $this->renderBreadcrumbs($page, $item);

        return response()
            ->view('site.pages.static.patientsSingle', compact('page', 'item', 'gallery','seo','videoGallery', 'breadcrumbs'));
    }

}
