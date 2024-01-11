<?php

namespace App\Models;

use App\Traits\HasTranslations;
use App\Traits\Sortable;

class DatabaseContent extends AbstractModel
{
    //use HasTranslations, Sortable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'completed_projects_ml';
}
