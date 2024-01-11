<?php

namespace App\Models;

class Message extends AbstractModel
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'message',
        'created_at',
        'updated_at'
    ];

    /**
     * @var array[]
     */
    public static $imageSizes = [
        [
            'width' => 1,
            'height' => 1,
            'entityPath' => 'messages',
            'size' => 'thumbnail',
        ],
    ];

    /**
     * @var string
     */
    public static $imagePath = '/messages/';
}
