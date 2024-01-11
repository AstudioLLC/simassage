<?php

namespace App\Http\Controllers\Site\Cabinet;

use App\Http\Controllers\Site\BaseController;

class NotificationController extends BaseController
{
    /**
     * View namespace for Cabinet
     * @var string
     */
    protected $viewsNamespace = 'site.pages.cabinet.';

    public function index()
    {
        $this->staticSEO(__('frontend.cabinet.Notification'));

        $breadcrumbs = [
            [
                'title' => __('frontend.cabinet.Notification'),
                'url' => ''
            ]
        ];

        $user = auth()->user();
        $active = 'notification';

        return response()
            ->view($this->viewsNamespace.'notification.index', compact('user', 'breadcrumbs', 'active'));
    }
}
