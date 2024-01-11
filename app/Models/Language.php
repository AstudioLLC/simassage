<?php

namespace App\Models;

use App\Traits\Sortable;
use Illuminate\Support\Facades\Cache;

class Language extends AbstractModel
{
    use Sortable;

    /**
     * @var bool
     */
    protected $sortableDesc = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'iso',
        'title',
        'active',
        'default',
        'admin',
        'url',
        'ordering',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public static function clearCaches()
    {

        Cache::forget(self::cacheKeyIsos());
        Cache::forget(self::cacheKeyLanguages());
    }

    private static function cacheKeyIsos()
    {
        return 'language_isos';
    }

    private static function cacheKeyLanguages()
    {
        return 'all_languages';
    }

    public static function getAll()
    {
        return self::sort()->get();
    }

    public static function isValid($iso)
    {
        return (self::query()->where('iso', $iso)->count() != 0);
    }

    public static function getIsos()
    {

        return Cache::rememberForever(self::cacheKeyIsos(), function () {
            self::clearCaches();
            return self::query()->select('id', 'iso')->where('active', 1)->get()->mapWithKeys(function ($item) {
                return [$item->id => $item->iso];
            })->toArray();
        });
    }

    public static function getLanguages()
    {
        return Cache::rememberForever(self::cacheKeyLanguages(), function () {
            self::clearCaches();
            return self::sort()->where('active', 1)->get();
        });
    }

    public static function getUrlLang()
    {
//        $language = DB::table('languages')->where('id', settings('url_language', 1))->first();
        $language = self::where('url', 1)->first();

        return $language ? $language->iso : app()->getLocale();
    }
}
