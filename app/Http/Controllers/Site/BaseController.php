<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Information;
use App\Models\Language;
use App\Models\NotificationText;
use App\Models\Page;
use App\Models\Social;
use App\Models\SuccessStory;
use App\Models\User;
use App\Services\BasketService\BasketFactory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\Service;
use App\Models\Time;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


abstract class BaseController extends Controller
{

    protected $shared = [];

    protected function view_share()
    {
        if (count($this->shared)) return false;

        $locale = app()->getLocale();
        $languages = Language::where('active', 1)->sort()->get();

        $isos = [];
        foreach ($languages as $language) {
            if ($language->admin == 1) {
                $this->lang = $language->iso;
            }
            if ($language->default == 1) {
                $this->urlLang = $language->iso;
            }
            $isos[] = $language->iso;
        }

        $homepage = Page::query()->where('static', 'home')->first();
        $topPages = Page::where(['parent_id' => null, 'active' => 1, 'to_top' => 1])->with('childrenForHeader')->sort()->get();
        $topPagesParent = Page::where(['parent_id' => 48,'active' => 1, 'to_top' => 1])->with('childrenForHeader')->sort()->get();
        $general_footer = Page::where(['active' => 1, 'to_footer' => 1])->whereNull('parent_id')->with('childrenForHeader')->sort()->get();
        $footerPages = Page::where(['parent_id' => 67, 'active' => 1, 'to_footer' => 1])->with('childrenForFooter')->sort()->get();
        $information = Information::where('active', 1)->first();
        $abouts_footer = Page::where(['parent_id' => 48, 'active' => 1, 'to_footer' => 1])->limit(7)->sort()->get();
        $socials = Social::where('active', 1)->sort()->get();
        $cart_data =  unserialize(base64_decode(DB::table('sessions')->where('id', session()->getId())->value('basket_items')));
        $footerPagesMain = Page::where('to_top',0)->where('static','!=','home')->sort()->get();
        $footerPagesInfo = $footerPagesMain->merge(Page::where(['parent_id' => 48,'active' => 1, 'to_footer' => 1])->sort()->get());
        $departments = Page::where(['parent_id'=>67,'active'=>true])->sort()->get();
        $time = Time::where('deleted_at',null)->get();
        $notifyText = NotificationText::first();

        $this->shared = [
            'locale' => $locale,
            'languages' => $languages,
            'isos' => $isos,
            'homepage' => $homepage,
            'topPages' => $topPages,
            'footerPages' => $footerPages,
            'footerPagesInfo' => $footerPagesInfo,
            'general_footer' => $general_footer,
            'socials' => $socials,
            'cart_data' => $cart_data,
            'departments' => $departments,
            //'services_footer' => $services_footer,
            'information' => $information,
            'abouts_footer' => $abouts_footer,
            'topPagesParent' => $topPagesParent,
            'time' => $time,
            'notifyText' => $notifyText,
        ];

        view()->share($this->shared);

        if (Auth::check()) {
            $user = User::query()->where('id', authUser()->id)->first();

            if (!empty($user)) {
                $user->last_activity_at = Carbon::now()->toDateTimeString();
                $user->save();
            }
        }

        return true;
        /*if (count($this->shared)) return false;
        //$this->shared['infos'] = Banner::get('info');

        $this->shared['locale'] = app()->getLocale();
        $this->shared['languages'] = Language::getLanguages();
        $other_languages = [];
        foreach ($this->shared['languages'] as $language) {
            if ($language->iso == $this->shared['locale']) $this->shared['current_language'] = $language;
            else $other_languages[] = $language;
        }
        $this->shared['other_languages'] = $other_languages;
        $this->shared['homepage'] = Page::query()->where('static', 'home')->first();

        $this->shared['pages'] = Page::where('active', true)->sort()->get();
        //$this->shared['categories'] = Category::sort()->with(['children', 'items'])->where('deep', 0)->has('children')->get();
        //$this->shared['categories'] = Category::sort()->where('deep', 0)->with(['children'])->get();
        $this->shared['current_url'] = url()->current();
        //$this->shared['suffix'] = $this->shared['infos']->seo->title_suffix;
        //$this->shared['urlLang'] = 'en';
        //$this->shared['contacts'] = $this->shared['infos']->contacts->flip();
        //$this->shared['footer_categories'] = Category::query()->where('is_footer', 1)->inRandomOrder()->limit(10)->get();
        //$this->shared['footer_categories'] = Category::query()->has('items')->inRandomOrder()->limit(12)->get();
        //$this->shared['home_banners'] = Banner::get('home');
        //$this->shared['basketService'] = BasketFactory::createDriver();
        if (Auth::check()) {
            $user = User::query()->where('id', authUser()->id)->first();

            if (!empty($user)) {
                $user->last_activity_at = Carbon::now()->toDateTimeString();
                $user->save();
            }
            //$this->shared['basket_fro_basket'] = Basket::where('user_id', auth()->user()->id)->pluck('item_id')->toArray();
            //$this->shared['basket_parts'] = Basket::getUserItems();
        }

        $languages = Language::sort()->select('id', 'iso', 'title')->where('active', '>=', '0')->get();
        $isos = [];
        $admin_language = settings('admin_language', 1);
        $url_language = settings('url_language', 4);

        foreach ($languages as $language) {
            if ($language->id == $admin_language) {
                $this->lang = $language->iso;
            }
            if ($language->id == $url_language) {
                $this->urlLang = $language->iso;
            }
            $languagesResult[] = [
                'iso' => $language->iso,
                'title' => $language->title,
            ];
            $isos[] = $language->iso;
        }
        $this->shared['isos'] = $isos;
        view()->share($this->shared);
        //dd($this->shared);

        return true;*/
    }

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->view_share();

            return $next($request);
        });
    }

    protected function renderSEO($item)
    {
        $seo = [
            'title' => $item->seo_title,
            'keywords' => $item->seo_keywords,
            'description' => $item->seo_description,
        ];
        if (!$seo['title']) {
            if ($item->static == 'home') {
                $title = '';
            } else {
                if (!$item->title) {
                    $title = $item->name;
                } else {
                    $title = $item->title;
                }
            }

            if (!empty($this->shared['suffix'])) {
                if ($title && $item->static != 'home') $title .= ' - ';
                $title .= $this->shared['suffix'];
            }
            $seo['title'] = $title;
        }
        return $seo;
    }

    protected function staticSEO($title)
    {
        $seo = ['title' => $title];
        if (!empty($this->shared['suffix'])) {
            if ($seo['title']) $seo['title'] .= ' - ';
            $seo['title'] .= $this->shared['suffix'];
        }

        return $seo;
    }

    protected function renderBreadcrumbs($page, $model = null)
    {
        $breadcrumbs = [];

        if ($page) {
            if ($page->parent_id !== null) {

                $parentPage = Page::where(['active' => 1, 'id' => $page->parent_id])->select('title', 'url')->first();
//            dd($parentPage);
//                if ($parentPage->parent_id !== null && $page->parent_id == 67) {
//
//                    $grandParentPage = Page::where(['active' => 1, 'id' => $parentPage->parent_id])->select('title', 'url')->first();
//                    $breadcrumbs[] = [
//                        'title' => $grandParentPage->title,
//                        'url' => route('subpage', ['url' => $grandParentPage->url])
//                    ];
//                }
                if ($parentPage->parent_id !== null) {
                    $grandParentPage = Page::where(['active' => 1, 'id' => $parentPage->parent_id])->select('title', 'url')->first();
                    $breadcrumbs[] = [
                        'title' => $grandParentPage->title,
                        'url' => route('page', ['url' => $grandParentPage->url])
                    ];
                }
                $breadcrumbs[] = [
                    'title' => $parentPage->title,
                    'url' => route('page', ['url' => $parentPage->url])
                ];
            }
            if ($page->parent_id == 67){
                $breadcrumbs[] = [
                    'title' => $page->title,
                    'url' => route('subpage', ['url' => $page->url])
                ];
            }else{
                $breadcrumbs[] = [
                    'title' => $page->title,
                    'url' => route('page', ['url' => $page->url])
                ];
            }

        }

        if ($model) {
            $breadcrumbs[] = [
                'title' => $model->title,
            ];
        }
        return $breadcrumbs;
    }
}
