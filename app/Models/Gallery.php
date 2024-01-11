<?php

namespace App\Models;

use App\Traits\HasTranslations;
use App\Traits\Sortable;

class Gallery extends AbstractModel
{
    use Sortable, HasTranslations;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'gallery',
        'key',
        'image',
        'alt',
        'title',
        'ordering'
    ];

    /**
     * @var string[]
     */
    public $translatable = [
        'alt',
        'title'
    ];

    /**
     * @var array[]
     */
    public static $imageSizes = [
        [
            'width' => 600,
            'height' => 700,
            'entityPath' => 'gallery',
            'size' => 'thumbnail',
        ],
        [
            'width' => 384,
            'height' => 434,
            'entityPath' => 'gallery',
            'size' => 'small',
        ]
    ];
    public static $imageSizesServices = [
        [
            'width' => 348,
            'height' => 427,
            'entityPath' => 'gallery',
            'size' => 'thumbnail',
        ],
        [
            'width' => 348,
            'height' => 427,
            'entityPath' => 'gallery',
            'size' => 'small',
        ]
    ];

    /**
     * @var string
     */
    public static $imagePath = '/gallery/';

}
