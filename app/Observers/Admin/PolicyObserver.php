<?php

namespace App\Observers\Admin;

use App\Models\Policy;
use App\Services\ImageUploader\Drivers\StorageDriver;
use App\Services\ImageUploader\ImageUploader;
use Illuminate\Support\Arr;

class PolicyObserver
{
    /**
     * Handle the Policy"created" event.
     *
     * @param  \App\Models\Policy $policy
     * @return void
     */
    public function created(Policy$policy)
    {
        $policy->ordering = $policy->sortValue();

        if (request()->file('imageBig')) {
            if (request()->get('old_imageBig')) {
                $policy->deleteItemImage(request()->get('old_imageBig'));
            }
            $imageBigName = ImageUploader::upload(request()->file('imageBig'), $policy::$imageBigSizes);
            $policy->imageBig = $imageBigName;
        }

        if (request()->file('imageSmall')) {
            if (request()->get('old_imageSmall')) {
                $policy->deleteItemImage(request()->get('old_imageSmall'));
            }
            $imageSmallName = ImageUploader::upload(request()->file('imageSmall'), $policy::$imageSmallSizes);
            $policy->imageSmall = $imageSmallName;
        }

        $policy->saveQuietly();
    }

    /**
     * Handle the Policy"updated" event.
     *
     * @param  \App\Models\Policy $policy
     * @return void
     */
    public function updated(Policy$policy)
    {
        if (request()->file('imageBig')) {
            if (request()->get('old_imageBig')) {
                $policy->deleteItemImage(request()->get('old_imageBig'));
            }
            $imageBigName = ImageUploader::upload(request()->file('imageBig'), $policy::$imageBigSizes);
            $policy->imageBig = $imageBigName;
        }

        if (request()->file('imageSmall')) {
            if (request()->get('old_imageSmall')) {
                $policy->deleteItemImage(request()->get('old_imageSmall'));
            }
            $imageSmallName = ImageUploader::upload(request()->file('imageSmall'), $policy::$imageSmallSizes);
            $policy->imageSmall = $imageSmallName;
        }

        $policy->saveQuietly();
    }

    /**
     * Handle the Policy"deleted" event.
     *
     * @param  \App\Models\Policy $policy
     * @return void
     */
    public function deleted(Policy$policy)
    {
        //
    }

    /**
     * Handle the Policy"restored" event.
     *
     * @param  \App\Models\Policy $policy
     * @return void
     */
    public function restored(Policy$policy)
    {
        //
    }

    /**
     * Handle the Policy"force deleted" event.
     *
     * @param  \App\Models\Policy $policy
     * @return void
     */
    public function forceDeleted(Policy$policy)
    {
        $storage = StorageDriver::instance();

        if ($policy->imageSmall) {
            foreach ($policy::$imageSmallSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $policy->imageSmall);
                $storage->delete($path);
            }
        }

        if ($policy->imageBig) {
            foreach ($policy::$imageBigSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $policy->imageBig);
                $storage->delete($path);
            }
        }
    }
}
