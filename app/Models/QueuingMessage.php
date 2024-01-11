<?php

namespace App\Models;

class QueuingMessage extends AbstractModel
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'phone',
        'email',
        'service',
        'day',
        'time',
        'message',
        'items',
        'doctor_name',
        'status_id',
        'comment',
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


    public function getItemsAttribute($value)
    {
        return json_decode($value,true);
    }

    public function status()
    {
        return $this->belongsTo(QueuingStatus::class, 'status_id');
    }

}
