<?php

namespace App\Http\Controllers\Site;

use App\Models\Gallery;
use App\Models\News;
use App\Models\Page;
use App\Models\Video;

class NewsController extends BaseController
{
    protected function detail($url)
    {
        $page = Page::where(['static' => 'news', 'active' => 1])->firstOrFail();
        $item = News::where(['url' => $url, 'active' => 1])->firstOrFail();

        $gallery = Gallery::where('key', $item->id)->sort()->get();
        $videoGallery = Video::where('key', $item->id)->sort()->get();
        $seo = $this->renderSEO($page);

        $this->renderSEO($item);
        $breadcrumbs = $this->renderBreadcrumbs($page, $item);

        return response()
            ->view('site.pages.static.newsSingle', compact('page', 'item', 'gallery','seo','videoGallery', 'breadcrumbs'));
    }

}
