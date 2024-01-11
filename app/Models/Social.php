<?php

namespace App\Models;

use App\Traits\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Social extends AbstractModel
{
    use Sortable, SoftDeletes;

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
        'image',
        'active',
        'ordering',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @var array[]
     */
    public static $imageSizes = [
        [
            'width' => 40,
            'height' => 40,
            'entityPath' => 'socials',
            'size' => 'thumbnail'
        ]
    ];

    /**
     * @var string
     */
    public static $imagePath = '/socials/';
}
