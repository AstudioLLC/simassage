<?php

namespace App\Http\Controllers\Site;

use App\Models\Administrator;
use App\Models\Department;
use App\Models\DepartmentsCategory;
use App\Models\DepartmentsInformation;
use App\Models\Directorate;
use App\Models\File;
use App\Models\Gallery;
use App\Models\Information;
use App\Models\Job;
use App\Models\Member;
use App\Models\News;
use App\Models\Page;
use App\Models\Policy;
use App\Models\Price;
use App\Models\Question;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Social;
use App\Models\Video;
use App\Services\PageManager\StaticPages;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class StaticPagesController extends BaseController
{
    use StaticPages;

    /**
     * @param $page
     *
     * @return \Illuminate\Http\Response
     */
    public function static_home($page)
    {
        $seo = $this->renderSEO($page);
        $this->renderSEO($page);
        $sliders = Slider::where('active', 1)->sort()->get();
        $about = Page::where(['active' => 1, 'static' => 'about'])->first();
        $home = Page::where(['active' => 1, 'static' => 'home'])->first();
        $homeVideo = Video::where(['video'=>'pages','key'=>$home->id])->first();
        $departments = Page::where(['parent_id' => 67, 'active' => true])->sort()->get();
        $doctors = Member::where(['active' => true, 'show_home' => true])->limit(6)->sort()->get();
        $news = News::where('active', 1)->orderBy('created_at', 'desc')->limit('4')->get();
        $contact = Page::where(['active' => 1, 'static' => 'contact'])->first();
        $questions = Question::where('active', 1)->inRandomOrder()->limit(3)->get();
        $galleryPage = Page::where('static','queuing')->first();
        $galleryPageMedia = Gallery::where('key', '63')->where('gallery', 'pages')->sort()->get();
        return response()
            ->view(
                'site.pages.static.home',
                compact(
                    'page',
                    'sliders',
                    'departments',
                    'doctors',
                    'about',
                    'seo',
                    'contact',
                    'news',
                    'home',
                    'questions',
                    'galleryPageMedia',
                    'galleryPage',
                    'homeVideo'
                )
            );
    }

    public function static_about($page)
    {
        $seo = $this->renderSEO($page);
        $this->renderSEO($page);
        $breadcrumbs = $this->renderBreadcrumbs($page);

        return response()
            ->view('site.pages.static.about', compact('page', 'seo','breadcrumbs'));
    }

    public function static_queuing($page)
    {
        $seo = $this->renderSEO($page);
        $this->renderSEO($page);
        $breadcrumbs = $this->renderBreadcrumbs($page);
        $services = Service::where('active', true)->get();
        $videoGallery = Video::query()->where('key', $page->id)->sort()->get();
        $gallery = Gallery::where('key', $page->id)->where('gallery', 'pages')->sort()->get();

        return response()
            ->view('site.pages.static.queuing', compact('page', 'seo', 'breadcrumbs', 'services','gallery','videoGallery'));
    }

    public function static_doctors($page)
    {
        $seo = $this->renderSEO($page);
        $this->renderSEO($page);
        $breadcrumbs = $this->renderBreadcrumbs($page);
        $doctors = Member::where(['active' => true])->with('department')->sort()->get();
        $departments = Page::where(['parent_id' => 67, 'active' => true])->get();


        return response()
            ->view('site.pages.static.doctors', compact('page', 'seo', 'breadcrumbs', 'doctors', 'departments'));
    }



    public function static_departments($page)
    {
        $seo = $this->renderSEO($page);
        $this->renderSEO($page);
        $breadcrumbs = $this->renderBreadcrumbs($page);
        $departments = Page::where(['parent_id' => $page->id, 'active' => true])->sort()->get();

        return response()
            ->view('site.pages.static.departments', compact('page', 'departments', 'seo', 'breadcrumbs'));
    }

    public function static_contact($page)
    {
        $seo = $this->renderSEO($page);
        $this->renderSEO($page);
        $information = Information::where(['id' => 1])->first();
        $socials = Social::where('active', 1)->sort()->get();
        $this->renderSEO($page);
        $breadcrumbs = $this->renderBreadcrumbs($page);

        return response()
            ->view('site.pages.static.contact', compact('page', 'seo', 'breadcrumbs', 'seo', 'information', 'socials'));
    }

    public function static_news($page)
    {
        $seo = $this->renderSEO($page);
        $this->renderSEO($page);
        $breadcrumbs = $this->renderBreadcrumbs($page);

        $news = News::where('active', 1)->orderBy('created_at', 'desc')->paginate('8');

        return response()
            ->view('site.pages.static.news', compact('page', 'seo', 'news', 'breadcrumbs'));
    }

    public function departmentPage($page)
    {
        $subPage = Page::where(['url' => $page, 'active' => 1])->first();
        $departmentServices = Department::where(['active' => true])->whereNotNull('static')->orWhere(
            'parent_id',
            $subPage->id
        )->where('active', true)->get();

        $departments_services = DepartmentsCategory::where('department_page_id', $subPage->id)->pluck('service_id');
        $departments_members = DepartmentsCategory::where('department_page_id', $subPage->id)->pluck('members_id');
        $departments_prices = DepartmentsCategory::where('department_page_id', $subPage->id)->pluck('price_id');
        $departments_information = DepartmentsCategory::where('department_page_id', $subPage->id)->pluck(
            'general_information'
        );
        $services = Service::whereIn('id', $departments_services)->get();
        $doctors = Member::whereIn('id', $departments_members)->sort()->get();
        $prices = Price::whereIn('id', $departments_prices)->get();
        $generalInfo = DepartmentsInformation::whereIn('id', $departments_information)->first();
        $dinamicContent = $departmentServices->where('parent_id', $subPage->id);
        $cart_data = unserialize(
            base64_decode(DB::table('sessions')->where('id', session()->getId())->value('basket_items'))
        );
        $gallery = Gallery::where('key', $subPage->id)->sort()->get();
        $videoGallery = Video::where('key', $subPage->id)->sort()->get();
        $breadcrumbs = $this->renderBreadcrumbs($subPage);
        $seo = $this->renderSEO($subPage);
        $this->renderSEO($subPage);

        return response()
            ->view(
                'site.pages.static.departmentsSingle',
                compact(
                    'page',
                    'seo',
                    'subPage',
                    'departmentServices',
                    'services',
                    'doctors',
                    'prices',
                    'generalInfo',
                    'dinamicContent',
                    'cart_data',
                    'gallery',
                    'videoGallery',
                    'breadcrumbs'
                )
            );
    }

    public function getMediaItemsView(string $pageAlias): View
    {
        $subPage = Page::query()->where(['url' => $pageAlias, 'active' => 1])->first();
        $gallery = Gallery::query()->where('key', $subPage->id)->sort()->get();
        $videoGallery = Video::query()->where('key', $subPage->id)->sort()->get();

        return view('site.includes.media-items', [
            'gallery' => $gallery,
            'videoGallery' => $videoGallery,
        ]);
    }

    public function static_success_stories($page)
    {
        $seo = $this->renderSEO($page);
        $this->renderSEO($page);
        $breadcrumbs = $this->renderBreadcrumbs($page);

        $items = SuccessStory::where('active', 1)->orderBy('created_at', 'desc')->paginate('12');

        return response()
            ->view('site.pages.static.success_stories', compact('page', 'seo', 'items', 'breadcrumbs'));
    }

    public function static_price_list($page)
    {
        $seo = $this->renderSEO($page);
        $this->renderSEO($page);
        $breadcrumbs = $this->renderBreadcrumbs($page);
        $allDepartments = Page::where(['active' => true, 'parent_id' => 67])->get();
        $departments_ids = $allDepartments->pluck('id')->toArray();

        $allDepartmentsPrice = Price::where(['active' => true])->whereIn('department_id', $departments_ids)->get();
        $allDepartmentsPriceIds = Price::where(['active' => true])->whereIn('department_id', $departments_ids)->pluck('department_id')->toArray();
        $cart_data = unserialize(
            base64_decode(DB::table('sessions')->where('id', session()->getId())->value('basket_items'))
        );

        return response()
            ->view(
                'site.pages.static.priceList',
                compact('page', 'seo', 'allDepartments', 'allDepartmentsPrice','allDepartmentsPriceIds', 'cart_data', 'breadcrumbs')
            );
    }


//    public function static_patent($page)
//    {
//        $seo = $this->renderSEO($page);
//        $this->renderSEO($page);
//        $breadcrumbs = $this->renderBreadcrumbs($page);
//        $gallery = Gallery::where('key', $page->id)->get();
//        $videoGallery = Video::where('key', $page->id)->sort()->get();
//        return response()
//            ->view('site.pages.static.patent', compact('page', 'seo', 'breadcrumbs', 'gallery', 'videoGallery'));
//    }
//
//    public function static_patient($page)
//    {
//        $seo = $this->renderSEO($page);
//        $this->renderSEO($page);
//        $breadcrumbs = $this->renderBreadcrumbs($page);
//        $gallery = Gallery::where('key', $page->id)->get();
//        $file = File::where('key', $page->id)->get();
//
//        $patient_page = Page::where(['static' => 'patient', 'active' => 1])->get()->pluck('id');
//
//        $patients = Page::where(['parent_id' => $patient_page, 'active' => 1])->get();
//
//        return response()
//            ->view('site.pages.static.patients', compact('page', 'seo', 'breadcrumbs', 'gallery', 'file', 'patients'));
//    }

//    public function static_story($page)
//    {
//        $seo = $this->renderSEO($page);
//        $this->renderSEO($page);
//        $breadcrumbs = $this->renderBreadcrumbs($page);
//        $gallery = Gallery::where('key', $page->id)->sort()->get();
//        $videoGallery = Video::where('key', $page->id)->sort()->get();
//
//
//        return response()
//            ->view('site.pages.static.story', compact('page', 'seo', 'gallery', 'videoGallery', 'breadcrumbs'));
//    }
//
//    public function static_information($page)
//    {
//        $seo = $this->renderSEO($page);
//        $this->renderSEO($page);
//        $breadcrumbs = $this->renderBreadcrumbs($page);
//        $gallery = Gallery::where('key', $page->id)->sort()->get();
//        $videoGallery = Video::where('key', $page->id)->sort()->get();
//        $file = File::where('key', $page->id)->get();
//
//        $services = Service::where('active', 1)->orderBy('created_at', 'desc')->get();
//
//        return response()
//            ->view(
//                'site.pages.static.information',
//                compact('page', 'seo', 'gallery', 'videoGallery', 'file', 'services', 'breadcrumbs')
//            );
//    }

//    public function static_directorate($page)
//    {
//        $seo = $this->renderSEO($page);
//        $this->renderSEO($page);
//        $breadcrumbs = $this->renderBreadcrumbs($page);
//
//        $file = File::where('key', $page->id)->get();
//        $directors = Directorate::where('active',1)->sort()->get();
//        return response()
//            ->view('site.pages.static.directorate', compact('page', 'seo', 'file', 'breadcrumbs', 'directors'));
//    }
//
//    public function static_administration($page)
//    {
//        $seo = $this->renderSEO($page);
//        $this->renderSEO($page);
//        $breadcrumbs = $this->renderBreadcrumbs($page);
//
//        $file = File::where('key', $page->id)->get();
//        $directors = Administrator::where('active',1)->sort()->get();
//        return response()
//            ->view('site.pages.static.administration', compact('page', 'seo', 'file', 'breadcrumbs', 'directors'));
//    }

    public function static_question($page)
    {
        $seo = $this->renderSEO($page);
        $this->renderSEO($page);
        $breadcrumbs = $this->renderBreadcrumbs($page);

        $question = Question::where('active', 1)->orderBy('created_at', 'desc')->get();

        return response()
            ->view('site.pages.static.questions', compact('page', 'seo', 'breadcrumbs', 'question'));
    }

    public function static_job($page)
    {
        $seo = $this->renderSEO($page);
        $this->renderSEO($page);
        $breadcrumbs = $this->renderBreadcrumbs($page);

        $jobs = Job::where('active', 1)->orderBy('created_at', 'desc')->get();

        return response()
            ->view('site.pages.static.job', compact('page', 'seo', 'breadcrumbs', 'jobs'));
    }


    public function static_faq($page)
    {
        $items = Page::where('active', 1)->whereHas('faq')->with('faq')->sort()->get();
        $active = $items->first();

        $seo = $this->renderSEO($page);
        $this->renderSEO($page);
        $breadcrumbs = $this->renderBreadcrumbs($page);

        return response()
            ->view('site.pages.static.faq', compact('page', 'seo', 'breadcrumbs', 'items', 'active'));
    }

    public function static_video_gallery($page)
    {
        $items = Page::where(['active' => 1, 'static' => 'video_gallery'])->first();

        $seo = $this->renderSEO($page);
        $this->renderSEO($page);
        $breadcrumbs = $this->renderBreadcrumbs($page);

        return response()
            ->view('site.pages.static.video_gallery', compact('page', 'seo', 'breadcrumbs', 'items'));
    }


//    public function static_company($page)
//    {
//        $seo = $this->renderSEO($page);
//        $this->renderSEO($page);
//        $breadcrumbs = $this->renderBreadcrumbs($page);
//
//        return response()
//            ->view('site.pages.static.company', compact('page', 'seo', 'breadcrumbs'));
//    }
//
//
//    public function static_policy($page)
//    {
//        $seo = $this->renderSEO($page);
//        $this->renderSEO($page);
//        $breadcrumbs = $this->renderBreadcrumbs($page);
//
//        $policy = Policy::where('active', 1)->orderBy('created_at', 'desc')->get();
//
//        return response()
//            ->view('site.pages.static.policy', compact('page', 'seo', 'breadcrumbs', 'policy'));
//    }
//
//
//    public function static_sms_donation($page)
//    {
//        $faq = Page::where(['active' => 1, 'static' => 'faq'])->first();
//        $news = News::where('active', 1)->limit(10)->inRandomOrder()->get();
//
//        $seo = $this->renderSEO($page);
//        $this->renderSEO($page);
//        $breadcrumbs = $this->renderBreadcrumbs($page);
//
//        return response()
//            ->view('site.pages.static.sms_donation', compact('page', 'seo', 'breadcrumbs', 'faq', 'news'));
//    }
//
//    public function static_day_care($page)
//    {
//        $faq = Page::where(['active' => 1, 'static' => 'faq'])->first();
//        $fundraisers = Fundraiser::where('active', 1)->sort()->get();
//
//        $payment = false;
//        if (\session()->get('fundraiser_payment')) {
//            \session()->forget('fundraiser_payment');
//            $payment = true;
//        }
//
//        $seo = $this->renderSEO($page);
//        $this->renderSEO($page);
//        $breadcrumbs = $this->renderBreadcrumbs($page);
//
//        return response()
//            ->view(
//                'site.pages.static.day_care',
//                compact('page', 'seo', 'breadcrumbs', 'faq', 'fundraisers', 'payment')
//            );
//    }
//
//    public function static_become_a_sponsor($page)
//    {
//        $faq = Page::where(['active' => 1, 'static' => 'faq'])->first();
//
//        $seo = $this->renderSEO($page);
//        $this->renderSEO($page);
//        $breadcrumbs = $this->renderBreadcrumbs($page);
//
//        return response()
//            ->view('site.pages.static.become_a_sponsor', compact('page', 'seo', 'breadcrumbs', 'faq'));
//    }
//
//
//
//    public function static_support_our_programs($page)
//    {
//        $seo = $this->renderSEO($page);
//        $this->renderSEO($page);
//        $breadcrumbs = $this->renderBreadcrumbs($page);
//
//        return response()
//            ->view('site.pages.static.support_our_programs', compact('page', 'seo', 'breadcrumbs'));
//    }
//
//    public function static_corporate_partnership($page)
//    {
//        $seo = $this->renderSEO($page);
//        $this->renderSEO($page);
//        $breadcrumbs = $this->renderBreadcrumbs($page);
//        $day_care = Page::where(['active' => 1, 'static' => 'day_care'])->first();
//        //TODO add current campaigns part
//        $tailored_project = Page::where(['active' => 1, 'static' => 'tailored_project'])->first();
//
//        return response()
//            ->view(
//                'site.pages.static.corporate_partnership',
//                compact('page', 'seo', 'breadcrumbs', 'day_care', 'tailored_project')
//            );
//    }
//
//    public function static_tailored_project($page)
//    {
//        $seo = $this->renderSEO($page);
//        $this->renderSEO($page);
//        $breadcrumbs = $this->renderBreadcrumbs($page);
//
//        return view('site.pages.static.tailored_project', compact('page', 'seo', 'breadcrumbs'));
//    }


    private function dynamic_page($page)
    {
        $seo = $this->renderSEO($page);
        $this->renderSEO($page);
        $breadcrumbs = $this->renderBreadcrumbs($page);
        $subPage = Page::where('parent_id', $page->id)->get();
        $gallery = Gallery::where('key', $page->id)->sort()->get();
        $videoGallery = Video::where('key', $page->id)->sort()->get();
        $file = File::where('key', $page->id)->get();

        return view(
            'site.pages.dynamic_page',
            compact('page', 'subPage', 'gallery', 'videoGallery', 'file', 'seo', 'breadcrumbs')
        );
    }
}
