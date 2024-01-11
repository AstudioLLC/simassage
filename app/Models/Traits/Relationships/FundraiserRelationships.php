<?php

namespace App\Models\Traits\Relationships;

use App\Models\Donation;

trait FundraiserRelationships
{
    public function donations()
    {
        return $this->hasMany(Donation::class, 'fundraiser_id')->orderBy('created_at', 'asc');
    }
}
