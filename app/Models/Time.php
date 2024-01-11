<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Sortable;

class Time extends AbstractModel
{
    use HasFactory,Sortable;
     /**
     * @var bool
     */
    protected $sortableDesc = false;

    protected $fillable = ['hour','minute'];
}
