<?php

namespace App\Http\Controllers\Site;

use App\Models\Brand;

class BrandsController extends BaseController
{
    protected function detail($url)
    {
        $pageData['item'] = Brand::query()->where('active', 1)->where('url', $url)->with('items')->firstOrFail();

        $this->renderSEO($pageData['item']);

        $breadcrumbs = [];

        $breadcrumbs[] = [
            'title' => $pageData['item']->title,
            'url' => route('brands.detail', ['url' => $pageData['item']->url])
        ];

        $pageData['breadcrumbs'] = $breadcrumbs;

        //dd($pageData['item']);

        return view('site.pages.brands.detail', $pageData);
    }
}
