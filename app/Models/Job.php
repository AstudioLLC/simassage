<?php

namespace App\Models;

use App\Traits\HasTranslations;
use App\Traits\Sortable;
use App\Traits\UrlUnique;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends AbstractModel
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
        'content',
        'working_hours',
        'file',
        'active',
        'ordering',
        'salary',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @var string[]
     */
    public $translatable = [
        'title',
        'content',
    ];


}
