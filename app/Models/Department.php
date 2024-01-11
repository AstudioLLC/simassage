<?php

namespace App\Models;

use App\Models\Traits\Relationships\NewsRelationships;
use App\Traits\HasTranslations;
use App\Traits\Sortable;
use App\Traits\UrlUnique;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends AbstractModel
{
    use HasTranslations, Sortable, UrlUnique, SoftDeletes, NewsRelationships;

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
        'static',
        'url',
        'title',
        'imageSmall',
        'imageSmallSecond',
        'imageBig',
        'short',
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
        'short',
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
            'entityPath' => 'departments',
            'size' => 'thumbnail'
        ]
    ];

    /**
     * @var string
     */
    public static $imagePath = '/departments/';

    /**
     * @var array[]
     */
    public static $imageSmallSizes = [
        [
            'width' => 705,
            'height' => 425,
            'entityPath' => 'departments',
            'size' => 'thumbnail',
        ]
    ];

    /**
     * @var array[]
     */
    public static $imageBigSizes = [
        [
            'width' => 995,
            'height' => 600,
            'entityPath' => 'departments',
            'size' => 'thumbnail',
        ]
    ];
}
