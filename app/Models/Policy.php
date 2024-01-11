<?php

namespace App\Models;

use App\Traits\HasTranslations;
use App\Traits\Sortable;
use App\Traits\UrlUnique;
use Illuminate\Database\Eloquent\SoftDeletes;

class Policy extends AbstractModel
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
        'title',
        'file',
        'imageSmall',
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
    ];

    public static $imageSizes = [
        [
            'width' => 1,
            'height' => 1,
            'entityPath' => 'Policy',
            'size' => 'thumbnail'
        ]
    ];

    /**
     * @var string
     */
    public static $imagePath = '/Policy/';

    /**
     * @var array[]
     */
    public static $imageSmallSizes = [
        [
            'width' => 33,
            'height' => 33,
            'entityPath' => 'Policy',
            'size' => 'thumbnail',
        ]
    ];


}
