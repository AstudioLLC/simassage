<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Page;
use Illuminate\Http\Request;

class EventsController extends BaseController
{
    public function event($url){
        $page = Page::where(['static' => 'events', 'active' => 1])->firstOrFail();
        $item = Event::where(['url' => $url, 'active' => 1])->firstOrFail();

        $gallery = Gallery::where('key', $item->id)->get();
        $this->renderSEO($item);
        $breadcrumbs = $this->renderBreadcrumbs($page, $item);

        return response()
            ->view('site.pages.static.eventSingle', compact('page', 'item', 'gallery', 'breadcrumbs'));
    }
}
