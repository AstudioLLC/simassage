<?php

namespace App\Observers\Admin;

use App\Models\Social;
use App\Services\ImageUploader\Drivers\StorageDriver;
use App\Services\ImageUploader\ImageUploader;
use Illuminate\Support\Arr;

class SocialObserver
{
    /**
     * Handle the Social "created" event.
     *
     * @param  \App\Models\Social  $social
     * @return void
     */
    public function created(Social $social)
    {
        $social->ordering = $social->sortValue();
        if (request()->file('image')) {
            if (request()->get('old_image')) {
                $social->deleteItemImage(request()->get('old_image'));
            }
            $imageName = ImageUploader::upload(request()->file('image'), $social::$imageSizes);
            $social->image = $imageName;
        }
        $social->saveQuietly();
    }

    /**
     * Handle the Social "updated" event.
     *
     * @param  \App\Models\Social  $social
     * @return void
     */
    public function updated(Social $social)
    {
        if (request()->file('image')) {
            if (request()->get('old_image')) {
                $social->deleteItemImage(request()->get('old_image'));
            }

            $imageName = ImageUploader::upload(request()->file('image'), $social::$imageSizes);
            $social->image = $imageName;
            $social->saveQuietly();
        }
    }

    /**
     * Handle the Social "deleted" event.
     *
     * @param  \App\Models\Social  $social
     * @return void
     */
    public function deleted(Social $social)
    {
        //
    }

    /**
     * Handle the Social "restored" event.
     *
     * @param  \App\Models\Social  $social
     * @return void
     */
    public function restored(Social $social)
    {
        //
    }

    /**
     * Handle the Social "force deleted" event.
     *
     * @param  \App\Models\Social  $social
     * @return void
     */
    public function forceDeleted(Social $social)
    {
        $storage = StorageDriver::instance();

        if ($social->image) {
            foreach ($social::$imageSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $social->image);
                $storage->delete($path);
            }
        }
    }
}
