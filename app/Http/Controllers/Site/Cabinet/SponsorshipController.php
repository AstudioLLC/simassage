<?php

namespace App\Http\Controllers\Site\Cabinet;

use App\Http\Controllers\Site\BaseController;
use App\Models\Children;
use Illuminate\Http\Request;

class SponsorshipController extends BaseController
{
    /**
     * View namespace for Cabinet
     * @var string
     */
    protected $viewsNamespace = 'site.pages.cabinet.';

    public function index()
    {
        $this->staticSEO(__('frontend.cabinet.My Sponsorship'));

        $breadcrumbs = [
            [
                'title' => __('frontend.cabinet.My Sponsorship'),
                'url' => ''
            ]
        ];

        $user = auth()->user();
        $active = 'sponsorship';
        $childrens = Children::where(['sponsor_id' => auth()->user()->id, 'active'=> 1])
            ->with(['gallery', 'files', 'videos'])
            ->sort()
            ->get();

        return response()
            ->view($this->viewsNamespace.'sponsorship.index', compact('user', 'breadcrumbs', 'active', 'childrens'));
    }

    public function createStep1(Request $request)
    {
        $this->staticSEO(__('frontend.cabinet.My Sponsorship'));

        $breadcrumbs = [
            [
                'title' => __('frontend.cabinet.My Sponsorship'),
                'url' => ''
            ]
        ];

        $user = auth()->user();
        $active = 'sponsorship';
        //$sponsorship = $request->session()->get('sponsorship');

        return response()
            ->view($this->viewsNamespace.'sponsorship.steps.step1', compact('user', 'breadcrumbs', 'active'));
    }
}
