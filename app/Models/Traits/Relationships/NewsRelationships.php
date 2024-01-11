<?php

namespace App\Models\Traits\Relationships;

use App\Models\Faq;
use App\Models\File;
use App\Models\Gallery;
use App\Models\Need;
use App\Models\Video;
use Illuminate\Support\Facades\DB;

trait NewsRelationships
{
    public function gallery()
    {
        return $this->hasMany(Gallery::class, 'key')->where('gallery', 'news')->orderBy('ordering', 'asc');
    }
    public function videos()
    {
        return $this->hasMany(Video::class, 'key')->where('video', 'news')->orderBy('ordering', 'asc');
    }
}
