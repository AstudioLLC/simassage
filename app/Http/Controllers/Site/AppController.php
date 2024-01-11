<?php

namespace App\Http\Controllers\Site;

use App\Models\Slider;
use App\Services\PageManager\StaticPages;

class AppController extends BaseController
{
    use StaticPages;

    /**
     * @param $page
     * @return \Illuminate\Http\Response
     */
    public function static_home($page)
    {
//        dd($page);
        $slider = Slider::where('active', 1)->sort()->get();

        return response()->view('site.pages.static.home', compact('page', 'slider'));
        /*$filename = 'file:///C:/OpenServer/domains/rv-comfort/public/u/webdata/import0_1.xml';


        $xml = simplexml_load_file($filename);//выгрузили файл
        //dd($xml->Каталог->Товары);
        foreach ($xml->Каталог->Товары as $row => $value) {
            if ($row <= 20) {
                echo "<pre>"; print_r($value);
            }
        }
        exit();
        $ttl = $xml->movies->movie->title; //получили заголовок. он один, так что [0] или другое значение ставить не надо

        foreach ($xml->movies->movie->caracters as $crc) // а теперь поработаем в динамике
        {
            //выведем имена героев
            $name = $crc->caracter->name;
            echo ("$name <br>");
        }*/



        /*$pageData['seo'] = $this->renderSEO($page);
        $pageData = [];
        $pageData['slider'] = MainSlide::getHeaderSlides();
        if (!count($pageData['slider'])) {
            $pageData['videos'] = Video::getVideos();
        }
        $pageData['brands'] = Brand::getHeaderBrands();

        $pageData['homeBanners'] = HomeBanner::getHomeBanners();

        $pageData['discountItems'] = Item::query()
            ->inRandomOrder()
            ->where('active', 1)
            ->where('discount', '!=', null)
            ->take(5)
            ->get();

        $pageData['promotiontItems'] = Item::query()
            ->inRandomOrder()
            ->where('active', 1)
            ->where('is_promotion', 1)
            ->take(5)
            ->get();

        $pageData['newItems'] = Item::query()
            ->inRandomOrder()
            ->where('active', 1)
            ->where('is_new', 1)
            ->take(5)
            ->get();

        $pageData['services'] = Service::sort()
            ->where('active', 1)
            ->take(6)
            ->get();

        $pageData['staticNews'] = Page::query()
            ->select('title', 'static')
            ->where('static', 'news')
            ->first();

        $pageData['news'] = News::homeList();
        $pageData['home'] = Banner::get('home');
        $pageData['home_big_image_banners'] = Banner::get('home_big_image_banners');

        return view('site.pages.home.index', $pageData);*/
    }

    /*public function static_news($pageData)
    {
        $pageData['seo'] = $this->renderSEO($pageData);
        $breadcrumbs = [];
        $breadcrumbs[] = [
            'title' => $pageData->title,
            'url' => route('page', ['url' => $pageData->static == $this->shared['homepage']->static ? null : $pageData->url])
        ];
        $pageData['breadcrumbs'] = $breadcrumbs;
        $newsContent = Banner::getBanner($pageData->static);
        if (count($newsContent)){
            $newsContent = $newsContent['data'][0];
        }
        $pageData['newsContent'] = $newsContent;
        $pageData['news'] = News::siteList();
        $pageData['gallery'] = Gallery::get($pageData->static, $pageData->id);

        $pageData['files'] = File::where(['file' => $pageData->static, 'key' => $pageData->id])->get();

        return view('site.pages.static.news', $pageData);
    }

    public function static_about($pageData)
    {
        $pageData['seo'] = $this->renderSEO($pageData);
        $breadcrumbs = [];
        $breadcrumbs[] = [
            'title' => $pageData->title,
            'url' => route('page', ['url' => $pageData->static == $this->shared['homepage']->static ? null : $pageData->url])
        ];
        $pageData['breadcrumbs'] = $breadcrumbs;

        $aboutContent = Banner::getBanner($pageData->static);
        if (count($aboutContent)){
            $aboutContent = $aboutContent['data'][0];
        }
        $pageData['aboutContent'] = $aboutContent;
        $pageData['gallery'] = Gallery::get($pageData->static, $pageData->id);

        $pageData['files'] = File::where(['file' => $pageData->static, 'key' => $pageData->id])->get();

        return view('site.pages.static.about', $pageData);
    }

    public function static_contacts($pageData)
    {
        $pageData['seo'] = $this->renderSEO($pageData);
        $breadcrumbs = [];
        $breadcrumbs[] = [
            'title' => $pageData->title,
            'url' => route('page', ['url' => $pageData->static == $this->shared['homepage']->static ? null : $pageData->url])
        ];
        $pageData['breadcrumbs'] = $breadcrumbs;
        $contactstContent = Banner::getBanner($pageData->static);
        if (count($contactstContent)){
            $contactstContent = $contactstContent['data'][0];
        }
        $pageData['contactsContent'] = $contactstContent;
        $pageData['gallery'] = Gallery::get($pageData->static, $pageData->id);

        return view('site.pages.static.contacts', $pageData);
    }

    public function static_catalog($pageData)
    {
        $pageData['seo'] = $this->renderSEO($pageData);
        $breadcrumbs = [];
        $breadcrumbs[] = [
            'title' => $pageData->title,
            'url' => route('page', ['url' => $pageData->static == $this->shared['homepage']->static ? null : $pageData->url])
        ];
        $pageData['breadcrumbs'] = $breadcrumbs;

        $pageContent = Banner::getBanner($pageData->static);
        if (count($pageContent)){
            $pageContent = $pageContent['data'][0];
        }
        $pageData['pageContent'] = $pageContent;
        $pageData['gallery'] = Gallery::get($pageData->static, $pageData->id);

        $pageData['files'] = File::where(['file' => $pageData->static, 'key' => $pageData->id])->get();

        return view('site.pages.static.catalog', $pageData);
    }

    public function static_interiorDesign($pageData)
    {
        $pageData['seo'] = $this->renderSEO($pageData);
        $breadcrumbs = [];
        $breadcrumbs[] = [
            'title' => $pageData->title,
            'url' => route('page', ['url' => $pageData->static == $this->shared['homepage']->static ? null : $pageData->url])
        ];
        $pageData['breadcrumbs'] = $breadcrumbs;

        $pageContent = Banner::getBanner($pageData->static);
        if (count($pageContent)){
            $pageContent = $pageContent['data'][0];
        }
        $pageData['pageContent'] = $pageContent;
        $pageData['gallery'] = Gallery::get($pageData->static, $pageData->id);

        $pageData['files'] = File::where(['file' => $pageData->static, 'key' => $pageData->id])->get();

        return view('site.pages.static.interiorDesign', $pageData);
    }

    public function static_loan($pageData)
    {
        $pageData['seo'] = $this->renderSEO($pageData);
        $breadcrumbs = [];
        $breadcrumbs[] = [
            'title' => $pageData->title,
            'url' => route('page', ['url' => $pageData->static == $this->shared['homepage']->static ? null : $pageData->url])
        ];
        $pageData['breadcrumbs'] = $breadcrumbs;

        $pageContent = Banner::getBanner($pageData->static);
        if (count($pageContent)){
            $pageContent = $pageContent['data'][0];
        }
        $pageData['pageContent'] = $pageContent;
        $pageData['gallery'] = Gallery::get($pageData->static, $pageData->id);

        $pageData['files'] = File::where(['file' => $pageData->static, 'key' => $pageData->id])->get();

        return view('site.pages.static.loan', $pageData);
    }

    public function static_measurement($pageData)
    {
        $pageData['seo'] = $this->renderSEO($pageData);
        $breadcrumbs = [];
        $breadcrumbs[] = [
            'title' => $pageData->title,
            'url' => route('page', ['url' => $pageData->static == $this->shared['homepage']->static ? null : $pageData->url])
        ];
        $pageData['breadcrumbs'] = $breadcrumbs;

        $pageContent = Banner::getBanner($pageData->static);
        if (count($pageContent)){
            $pageContent = $pageContent['data'][0];
        }
        $pageData['pageContent'] = $pageContent;
        $pageData['gallery'] = Gallery::get($pageData->static, $pageData->id);

        $pageData['colors'] = ColorFilter::sort()->get();
        $pageData['sizes'] = Filter::where(['is_active' => 1, 'id' => 1])->with('criteria')->first();

        $pageData['files'] = File::where(['file' => $pageData->static, 'key' => $pageData->id])->get();

        return view('site.pages.static.measurement', $pageData);
    }

    public function static_promotions($pageData)
    {
        $pageData['seo'] = $this->renderSEO($pageData);
        $breadcrumbs = [];
        $breadcrumbs[] = [
            'title' => $pageData->title,
            'url' => route('page', ['url' => $pageData->static == $this->shared['homepage']->static ? null : $pageData->url])
        ];
        $pageData['breadcrumbs'] = $breadcrumbs;

        $pageContent = Banner::getBanner($pageData->static);
        if (count($pageContent)){
            $pageContent = $pageContent['data'][0];
        }
        $pageData['pageContent'] = $pageContent;
        $pageData['gallery'] = Gallery::get($pageData->static, $pageData->id);

        $pageData['files'] = File::where(['file' => $pageData->static, 'key' => $pageData->id])->get();

        $pageData['items'] = Item::query()
            ->where('active', 1)
            ->where('is_promotion', 1)
            ->sort()
            ->paginate(48);

        return view('site.pages.static.promotions', $pageData);
    }

    public function static_discounts($pageData)
    {
        $pageData['seo'] = $this->renderSEO($pageData);
        $breadcrumbs = [];
        $breadcrumbs[] = [
            'title' => $pageData->title,
            'url' => route('page', ['url' => $pageData->static == $this->shared['homepage']->static ? null : $pageData->url])
        ];
        $pageData['breadcrumbs'] = $breadcrumbs;

        $pageContent = Banner::getBanner($pageData->static);
        if (count($pageContent)){
            $pageContent = $pageContent['data'][0];
        }
        $pageData['pageContent'] = $pageContent;
        $pageData['gallery'] = Gallery::get($pageData->static, $pageData->id);

        $pageData['files'] = File::where(['file' => $pageData->static, 'key' => $pageData->id])->get();

        $pageData['items'] = Item::query()
            ->where('active', 1)
            ->where('discount', '!=', null)
            ->sort()
            ->paginate(48);

        return view('site.pages.static.promotions', $pageData);
    }

    public function static_newItems($pageData)
    {
        $pageData['seo'] = $this->renderSEO($pageData);
        $breadcrumbs = [];
        $breadcrumbs[] = [
            'title' => $pageData->title,
            'url' => route('page', ['url' => $pageData->static == $this->shared['homepage']->static ? null : $pageData->url])
        ];
        $pageData['breadcrumbs'] = $breadcrumbs;

        $pageContent = Banner::getBanner($pageData->static);
        if (count($pageContent)){
            $pageContent = $pageContent['data'][0];
        }
        $pageData['pageContent'] = $pageContent;
        $pageData['gallery'] = Gallery::get($pageData->static, $pageData->id);

        $pageData['files'] = File::where(['file' => $pageData->static, 'key' => $pageData->id])->get();

        $pageData['items'] = Item::query()
            ->where('active', 1)
            ->where('is_new', 1)
            ->sort()
            ->paginate(48);

        return view('site.pages.static.promotions', $pageData);
    }

    public function static_shops($pageData)
    {
        $pageData['seo'] = $this->renderSEO($pageData);
        $breadcrumbs = [];
        $breadcrumbs[] = [
            'title' => $pageData->title,
            'url' => route('page', ['url' => $pageData->static == $this->shared['homepage']->static ? null : $pageData->url])
        ];
        $pageData['breadcrumbs'] = $breadcrumbs;

        $aboutContent = Banner::getBanner($pageData->static);
        if (count($aboutContent)){
            $aboutContent = $aboutContent['data'][0];
        }
        $pageData['aboutContent'] = $aboutContent;
        $pageData['addresses'] = Address::where('active', 1)->sort()->get();
        $pageData['gallery'] = Gallery::get($pageData->static, $pageData->id);

        $pageData['files'] = File::where(['file' => $pageData->static, 'key' => $pageData->id])->get();

        return view('site.pages.static.shops', $pageData);
    }*/

    private function dynamic_page($page) {
        $data = ['active_page'=>$page->id, 'page_title'=>$page->title];
        $data['page'] = $page;
        $data['seo'] = $this->renderSEO($page);
        //$data['gallery'] = Gallery::get('pages', $page->id);
        return view('site.pages.dynamic_page', $data);
    }
}
