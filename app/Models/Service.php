<?php

namespace App\Models;

use App\Models\Traits\Relationships\NewsRelationships;
use App\Models\Traits\Relationships\ServicesRelationships;
use App\Traits\HasTranslations;
use App\Traits\Sortable;
use App\Traits\UrlUnique;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends AbstractModel
{
    use HasTranslations, Sortable, UrlUnique, SoftDeletes, ServicesRelationships;

    /**
     * @var bool
     */
    protected $sortableDesc = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'url',
        'title',
        'imageSmall',
        'imageBig',
        'content',
        'active',
        'ordering',
        'seo_title',
        'seo_description',
        'seo_keywords',
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
        'seo_title',
        'seo_description',
        'seo_keywords'
    ];

    /**
     * @var array[]
     */
    public static $imageSizes = [
        [
            'width' => 1,
            'height' => 1,
            'entityPath' => 'services',
            'size' => 'thumbnail'
        ]
    ];

    /**
     * @var string
     */
    public static $imagePath = '/services/';

    /**
     * @var array[]
     */
    public static $imageSmallSizes = [
        [
            'width' => 315,
            'height' => 215,
            'entityPath' => 'services',
            'size' => 'thumbnail',
        ]
    ];

    /**
     * @var array[]
     */
    public static $imageBigSizes = [
        [
            'width' => 1440,
            'height' => 560,
            'entityPath' => 'services',
            'size' => 'thumbnail',
        ]
    ];


}
