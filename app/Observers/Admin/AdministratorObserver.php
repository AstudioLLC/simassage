<?php

namespace App\Observers\Admin;

use App\Models\Administrator;

class AdministratorObserver
{
    /**
     * Handle the Administrator "created" event.
     *
     * @param  \App\Models\Administrator  $administrator
     * @return void
     */
    public function created(Administrator $administrator)
    {
        //
    }

    /**
     * Handle the Administrator "updated" event.
     *
     * @param  \App\Models\Administrator  $administrator
     * @return void
     */
    public function updated(Administrator $administrator)
    {
        //
    }

    /**
     * Handle the Administrator "deleted" event.
     *
     * @param  \App\Models\Administrator  $administrator
     * @return void
     */
    public function deleted(Administrator $administrator)
    {
        //
    }

    /**
     * Handle the Administrator "restored" event.
     *
     * @param  \App\Models\Administrator  $administrator
     * @return void
     */
    public function restored(Administrator $administrator)
    {
        //
    }

    /**
     * Handle the Administrator "force deleted" event.
     *
     * @param  \App\Models\Administrator  $administrator
     * @return void
     */
    public function forceDeleted(Administrator $administrator)
    {
        //
    }
}
