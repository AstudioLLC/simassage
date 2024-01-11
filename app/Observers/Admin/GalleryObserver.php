<?php

namespace App\Observers\Admin;

use App\Models\Gallery;
use App\Services\ImageUploader\Drivers\StorageDriver;
use Illuminate\Support\Arr;

class GalleryObserver
{
    /**
     * Handle the Gallery "created" event.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return void
     */
    public function created(Gallery $gallery)
    {
        //
    }

    /**
     * Handle the Gallery "updated" event.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return void
     */
    public function updated(Gallery $gallery)
    {
        //
    }

    /**
     * Handle the Gallery "deleted" event.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return void
     */
    public function deleted(Gallery $gallery)
    {
        if ($gallery->image) {
            $storage = StorageDriver::instance();
            foreach ($gallery::$imageSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $gallery->image);
                $storage->delete($path);
            }
        }
    }

    /**
     * Handle the Gallery "restored" event.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return void
     */
    public function restored(Gallery $gallery)
    {
        //
    }

    /**
     * Handle the Gallery "force deleted" event.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return void
     */
    public function forceDeleted(Gallery $gallery)
    {
        //
    }
}
