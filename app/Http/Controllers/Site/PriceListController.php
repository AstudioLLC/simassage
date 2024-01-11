<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\Price;
use App\Models\SuccessStory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PriceListController extends BaseController
{
    protected function detail($url)
    {

        $page = Page::where(['url' => $url, 'active' => 1])->firstOrFail();
        $prices = Price::where(['department_id'=>$page->id])->get();
        $cart_data = unserialize(base64_decode(DB::table('sessions')->where('id', session()->getId())->value('basket_items')));
        $gallery = Gallery::where('key', $page->id)->get();

        $seo = $this->renderSEO($page);
        $breadcrumbs = $this->renderBreadcrumbs($page);

        return response()
            ->view('site.pages.static.priceListSingle', compact('page', 'prices','cart_data', 'gallery', 'breadcrumbs','seo'));
    }
}
