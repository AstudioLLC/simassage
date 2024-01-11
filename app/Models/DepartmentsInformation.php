<?php

namespace App\Models;

use App\Traits\HasTranslations;
use App\Traits\Sortable;
use App\Traits\UrlUnique;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentsInformation extends AbstractModel
{
    use HasTranslations, Sortable, UrlUnique, SoftDeletes;

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
        'title',
        'imageSmall',
        'imageBig',
        'content',
        'active',
        'ordering',
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
    ];

    /**
     * @var array[]
     */
    public static $imageSizes = [
        [
            'width' => 1,
            'height' => 1,
            'entityPath' => 'Events',
            'size' => 'thumbnail'
        ]
    ];

    /**
     * @var string
     */
    public static $imagePath = '/Events/';

    /**
     * @var array[]
     */
    public static $imageSmallSizes = [
        [
            'width' => 110,
            'height' => 110,
            'entityPath' => 'Events',
            'size' => 'thumbnail',
        ]
    ];

    /**
     * @var array[]
     */
    public static $imageBigSizes = [
        [
            'width' => 960,
            'height' => 720,
            'entityPath' => 'Events',
            'size' => 'thumbnail',
        ]
    ];

    public static $imageSizesGallery = [
        [
            'width' => 960,
            'height' => 720,
            'entityPath' => 'gallery',
            'size' => 'thumbnail',
        ],
        [
            'width' => 270,
            'height' => 270,
            'entityPath' => 'gallery',
            'size' => 'small',
        ]
    ];

    public function gallery()
    {
        return $this->hasMany(Gallery::class, 'key')->where('gallery', 'events')->orderBy('ordering', 'asc');
    }

}
