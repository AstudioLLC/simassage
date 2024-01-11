<?php

namespace App\Models\Traits\Relationships;

use App\Models\DepartmentsCategory;
use App\Models\Faq;
use App\Models\File;
use App\Models\Gallery;
use App\Models\Service;
use App\Models\Video;

trait PageRelationships
{
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('ordering', 'asc');
    }

    public function childrenForHeader()
    {
        return $this->hasMany(self::class, 'parent_id')->where(['active' => 1, 'to_top' => 1])->orderBy('ordering', 'asc');
    }

    public function childrenForFooter()
    {
        return $this->hasMany(self::class, 'parent_id')->where(['active' => 1, 'to_footer' => 1])->orderBy('ordering', 'asc');
    }

    public function childrenWithTrashed()
    {
        return $this->hasMany(self::class, 'parent_id')->withTrashed()->orderBy('ordering', 'asc');
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class, 'key')->where('gallery', 'pages')->orderBy('ordering', 'asc');
    }
    public function videos()
    {
        return $this->hasMany(Video::class, 'key')->where('video', 'pages')->orderBy('ordering', 'asc');
    }

    public function files()
    {
        return $this->hasMany(File::class, 'key')->where('file', 'pages')->orderBy('ordering', 'asc');
    }

    public function faq()
    {
        return $this->hasMany(Faq::class, 'page_id')->where('video', 'pages')->orderBy('ordering', 'asc');
    }

}
