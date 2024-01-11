<?php

namespace App\Observers\Admin;

use App\Models\Language;

class LanguageObserver
{
    /**
     * Handle the Language "created" event.
     *
     * @param  \App\Models\Language  $language
     * @return void
     */
    public function created(Language $language)
    {
        $language->ordering = $language->sortValue();
        $language->saveQuietly();
    }

    /**
     * Handle the Language "updated" event.
     *
     * @param  \App\Models\Language  $language
     * @return void
     */
    public function updated(Language $language)
    {
        //
    }

    /**
     * Handle the Language "deleted" event.
     *
     * @param  \App\Models\Language  $language
     * @return void
     */
    public function deleted(Language $language)
    {
        //
    }

    /**
     * Handle the Language "restored" event.
     *
     * @param  \App\Models\Language  $language
     * @return void
     */
    public function restored(Language $language)
    {
        //
    }

    /**
     * Handle the Language "force deleted" event.
     *
     * @param  \App\Models\Language  $language
     * @return void
     */
    public function forceDeleted(Language $language)
    {
        //
    }
}
