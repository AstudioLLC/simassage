<?php

namespace App\Http\Controllers\Site\Cabinet;

use App\Http\Controllers\Site\BaseController;
use App\Models\Donation;

class DonationsController extends BaseController
{
    /**
     * View namespace for Cabinet
     * @var string
     */
    protected $viewsNamespace = 'site.pages.cabinet.';

    public function index()
    {
        $this->staticSEO(__('frontend.cabinet.My donations'));

        $breadcrumbs = [
            [
                'title' => __('frontend.cabinet.My donations'),
                'url' => ''
            ]
        ];

        $user = auth()->user();
        $donations = Donation::where(['sponsor_id' => $user->id, 'status' => 1])->orderBy('created_at', 'desc')->get();
        // TODO add download receipt in view blade
        $active = 'donations';

        return response()
            ->view($this->viewsNamespace.'donations.index', compact('user', 'breadcrumbs', 'active', 'donations'));
    }
}
