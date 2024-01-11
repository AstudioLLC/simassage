<?php

namespace App\Models;

use App\Traits\HasTranslations;
use App\Traits\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApply extends AbstractModel
{
    use HasFactory,Sortable;

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
        'phone',
        'email',
        'message',
        'file',
        'job_position',
        'created_at',
        'updated_at',
    ];

}
