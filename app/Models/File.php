<?php

namespace App\Models;

use App\Traits\HasTranslations;
use App\Traits\Sortable;

class File extends AbstractModel
{
    use Sortable, HasTranslations;

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'file',
        'key',
        'name',
        'title',
        'imageSmall',
        'imageBig',
        'ordering',
        'created_at',
        'updated_at'
    ];

    /**
     * @var string[]
     */
    public $translatable = [
        'title'
    ];

    /**
     * @var array[]
     */
    public static $imageSizes = [
        [
            'width' => 1,
            'height' => 1,
            'entityPath' => 'file',
            'size' => 'thumbnail',
        ],
    ];

    /**
     * @var string
     */
    public static $imagePath = '/file/';

    /**
     * @var array[]
     */
    public static $imageSmallSizes = [
        [
            'width' => 30,
            'height' => 30,
            'entityPath' => 'file',
            'size' => 'thumbnail',
        ]
    ];

    /**
     * @var array[]
     */
    public static $imageBigSizes = [
        [
            'width' => 829,
            'height' => 622,
            'entityPath' => 'file',
            'size' => 'thumbnail',
        ]
    ];

}
