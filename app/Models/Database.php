<?php

namespace App\Models;

use App\Traits\HasTranslations;
use App\Traits\Sortable;

class Database extends AbstractModel
{
    //use HasTranslations, Sortable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'donations_test';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'order_id',
        'mdorder',
        'status',
        'fundraiser_id',
        'gift_id',
        'is_binding',
        'bindingId',
        'sponsor_id',
        'children_id',
        'amount',
        'email',
        'fullname',
        'card_type',
        'message',
        'message_admin',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function content()
    {
        return $this->hasMany(DatabaseContent::class, 'id');
    }
}
