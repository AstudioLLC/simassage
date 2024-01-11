<?php

namespace App\Models;

use App\Traits\HasTranslations;
use App\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends AbstractModel
{
    use HasFactory,HasTranslations,Sortable;

    /**
     * @var bool
     */
    protected $sortableDesc = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'description',
        'image',
        'position',
        'url',
        'active',
        'created_at',
        'updated_at',
    ];

    public $translatable = ['name','position','description'];


    /**
     * @var array[]
     */
    public static $imageSizes = [
        [
            'width' => 1,
            'height' => 1,
            'entityPath' => 'Administrators',
            'size' => 'thumbnail'
        ]
    ];

    /**
     * @var string
     */
    public static $imagePath = '/Administrators/';

    /**
     * @var array[]
     */
    public static $imageBigSizes = [
        [
            'width' => 575,
            'height' => 575,
            'entityPath' => 'Administrators',
            'size' => 'thumbnail',
        ]
    ];

}
