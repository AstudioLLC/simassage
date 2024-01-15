<?php

namespace App\Models;

use App\Models\Traits\Relationships\PageRelationships;
use App\Traits\HasTranslations;
use App\Traits\Sortable;
use App\Traits\UrlUnique;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Page extends AbstractModel
{
    use HasTranslations, Sortable, UrlUnique, SoftDeletes, PageRelationships;

    /**
     * @var bool
     */
    protected $sortableDesc = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'parent_id',
        'url',
        'title',
        'icon',
        'image',
        'show_image',
        'to_top',
        'to_menu',
        'to_footer',
        'content',
        'title_content',
        'content_second',
        'title_content_second',
        'active',
        'ordering',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'info_url',
        'phone',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @var string[]
     */
    public $translatable = [
        'title',
        'content',
        'title_content',
        'content_second',
        'title_content_second',
        'seo_title',
        'seo_description',
        'seo_keywords'
    ];

    /**
     * @var array[]
     */
    public static $imageSizesHome = [
        [
            'width' => 1920,
            'height' => 800,
            'entityPath' => 'pages',
            'size' => 'thumbnail'
        ]
    ];
    public static $imageSizesAbout = [
        [
            'width' => 376,
            'height' => 547,
            'entityPath' => 'pages',
            'size' => 'thumbnail'
        ]
    ];
    public static $imageSizesInformation = [
        [
            'width' => 100,
            'height' => 100,
            'entityPath' => 'pages',
            'size' => 'thumbnail'
        ]
    ];
    public static $imageSizesServices = [
        [
            'width' => 930,
            'height' => 560,
            'entityPath' => 'pages',
            'size' => 'thumbnail'
        ]
    ];
    public static $imageSizes = [
        [
            'width' => 1440,
            'height' => 482,
            'entityPath' => 'pages',
            'size' => 'thumbnail'
        ]
    ];

    /**
     * @var array[]
     */
    public static $iconSizes = [
        [
            'width' => 374,
            'height' => 230,
            'entityPath' => 'pages',
            'size' => 'thumbnail'
        ]
    ];
    public static $iconSizesStructure = [
        [
            'width' => 333,
            'height' => 447,
            'entityPath' => 'pages',
            'size' => 'thumbnail'
        ]
    ];

    /**
     * @var string
     */
    public static $imagePath = '/pages/';

    public static $imageGalleryPage = [
        [
            'width' => 630,
            'height' => 550,
            'entityPath' => 'pages',
            'size' => 'thumbnail'
        ]
    ];

    private static function cacheKeyMenu()
    {
        return 'menu';
    }

    private static function cacheKeyStatic()
    {
        return 'pages_static';
    }

    public static function clearCaches()
    {
        Cache::forget(self::cacheKeyMenu());
        Cache::forget(self::cacheKeyStatic());
    }

    public static function getStaticPages()
    {
        return Cache::rememberForever(self::cacheKeyStatic(), function () {
            return self::query()->select('id', 'url', 'static', 'active')->whereNotNull('static')->get();
        });
    }

}
