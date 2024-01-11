<?php

namespace App\Models\Traits\Relationships;

use App\Models\Faq;
use App\Models\File;
use App\Models\Gallery;
use App\Models\Need;
use App\Models\Video;
use Illuminate\Support\Facades\DB;

trait ServicesRelationships
{
    public function gallery()
    {
        return $this->hasMany(Gallery::class, 'key')->where('gallery', 'services')->orderBy('ordering', 'asc');
    }
}
