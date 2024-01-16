<?php

namespace App\Models;

use App\Traits\HasTranslations;
use App\Traits\Sortable;

class NotificationText extends AbstractModel
{
    use Sortable, HasTranslations;

    /**
     * @var string
     */
    protected $table = 'notifications_text';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'contact_message',
        'thanks_message',
        'adult_message',
        'created_at',
        'updated_at'
    ];

    /**
     * @var string[]
     */
    public $translatable = [
        'contact_message',
        'thanks_message',
        'adult_message',
    ];
}
