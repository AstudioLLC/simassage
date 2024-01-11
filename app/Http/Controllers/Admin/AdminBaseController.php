<?php

namespace App\Http\Controllers\Admin;

use App\Constants\UserRole;
use App\Http\Controllers\Controller;
use App\Models\JobApply;
use App\Models\Language;
use App\Models\Message;
use App\Models\QueuingMessage;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class AdminBaseController extends Controller
{
    protected $languages;
    protected $lang;
    protected $isos;
    protected $urlLang;
    protected $shared;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!$this->shared) {
                $this->view_share();
            }

            return $next($request);
        });
    }

    protected function view_share()
    {
        $languages = Language::select('id', 'iso', 'title')->where('active', 1)->sort()->get();
        $languagesResult = [];
        $isos = [];
        $admin_language = Language::select('id')->where('admin', 1)->sort()->first()->id;
        $url_language = Language::select('id')->where('url', 1)->sort()->first()->id;
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
        $default_language = Language::where('default', 1)->first()->iso;
        if (!$this->lang) $this->lang = $default_language;
        if (!$this->urlLang) $this->urlLang = $default_language;
        $this->languages = $languagesResult;
        $this->isos = $isos;


        $this->shared = [
            //'items_count' => Item::all()->count(),
            'messages' => QueuingMessage::where('seen',0)->count(),
            'contact_messages' => Message::where('seen',0)->count(),
            'job_applications' => JobApply::where('seen',0)->count(),
            'messages_with_items' => QueuingMessage::where('seen',0)->whereNotNull('items')->count(),
            'new_users_count' => User::where(['watched' => 0, 'role' => UserRole::SPONSOR])->count(),
            'lang' => $this->lang,
            'languages' => $languagesResult,
            'isos' => $isos,
            'urlLang' => $this->urlLang,
//            'job_applies' => JobApply::where('seen',0)->count()
        ];
        view()->share($this->shared);
    }
}
