<?php

namespace App\Models;

use App\Traits\HasTranslations;
use App\Traits\Sortable;

class Information extends AbstractModel
{
    use Sortable, HasTranslations;

    /**
     * @var string
     */
    protected $table = 'information';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'address',
        'short',
        'phone',
        'phone2',
        'email',
        'email_2',
        'map',
        'active',
        'ordering',
        'created_at',
        'updated_at'
    ];

    /**
     * @var string[]
     */
    public $translatable = [
        'address',
        'short'
    ];

    /**
     * @var array[]
     */
    public static $imageSizes = [
        [
            'width' => 1,
            'height' => 1,
            'entityPath' => 'information',
            'size' => 'thumbnail',
        ],
    ];

    /**
     * @var string
     */
    public static $imagePath = '/information/';
}
