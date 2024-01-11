<?php

namespace App\Models;

use App\Traits\HasTranslations;
use App\Traits\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends AbstractModel
{
    use HasTranslations, Sortable, SoftDeletes;

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
        'description',
        'button_title',
        'image',
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
        'button_title',
        'description',
        'content',
    ];

    /**
     * @var array[]
     */
    public static $imageSizes = [
        [
            'width' => 1920,
            'height' => 980,
            'entityPath' => 'sliders',
            'size' => 'thumbnail'
        ]
    ];

    /**
     * @var string
     */
    public static $imagePath = '/sliders/';
}
