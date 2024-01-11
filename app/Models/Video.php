<?php

namespace App\Models;

use App\Traits\HasTranslations;
use App\Traits\Sortable;

class Video extends AbstractModel
{
    use Sortable, HasTranslations;

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'type',
        'video',
        'key',
        'name',
        'link',
        'title',
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
            'entityPath' => 'videos',
            'size' => 'thumbnail',
        ],
    ];

    /**
     * @var string
     */
    public static $imagePath = '/videos/';
}
