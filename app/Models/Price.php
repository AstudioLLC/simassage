<?php

namespace App\Models;

use App\Models\Traits\Relationships\NewsRelationships;
use App\Models\Traits\Relationships\ServicesRelationships;
use App\Traits\HasTranslations;
use App\Traits\Sortable;
use App\Traits\UrlUnique;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends AbstractModel
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
        'department_id',
        'title',
        'price',
        'active',
        'ordering',
        'price_code',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @var string[]
     */
    public $translatable = [
        'title',
    ];

    /**
     * @var array[]
     */
    public static $imageSizes = [
        [
            'width' => 1,
            'height' => 1,
            'entityPath' => 'prices',
            'size' => 'thumbnail'
        ]
    ];

    /**
     * @var string
     */
    public static $imagePath = '/prices/';

    /**
     * @var array[]
     */
    public static $imageSmallSizes = [
        [
            'width' => 344,
            'height' => 255,
            'entityPath' => 'prices',
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
            'entityPath' => 'prices',
            'size' => 'thumbnail',
        ]
    ];


}
