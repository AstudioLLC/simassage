<?php

namespace App\Observers\Admin;

use App\Models\Member;
use App\Services\ImageUploader\Drivers\StorageDriver;
use App\Services\ImageUploader\ImageUploader;
use Illuminate\Support\Arr;

class MembersObserver
{
    /**
     * Handle the Member "created" event.
     *
     * @param  \App\Models\Member  $members
     * @return void
     */
    public function created(Member $members)
    {
        $members->ordering = $members->sortValue();

        if (request()->file('imageBig')) {
            if (request()->get('old_imageBig')) {
                $members->deleteItemImage(request()->get('old_imageBig'));
            }
            $imageBigName = ImageUploader::upload(request()->file('imageBig'), $members::$imageBigSizes);
            $members->imageBig = $imageBigName;
        }

        if (request()->file('imageSmall')) {
            if (request()->get('old_imageSmall')) {
                $members->deleteItemImage(request()->get('old_imageSmall'));
            }
            $imageSmallName = ImageUploader::upload(request()->file('imageSmall'), $members::$imageSmallSizes);
            $members->imageSmall = $imageSmallName;
        }

        $members->saveQuietly();
    }

    /**
     * Handle the Member "updated" event.
     *
     * @param  \App\Models\Member  $members
     * @return void
     */
    public function updated(Member $members)
    {
        if (request()->file('imageBig')) {
            if (request()->get('old_imageBig')) {
                $members->deleteItemImage(request()->get('old_imageBig'));
            }
            $imageBigName = ImageUploader::upload(request()->file('imageBig'), $members::$imageBigSizes);
            $members->imageBig = $imageBigName;
        }

        if (request()->file('imageSmall')) {
            if (request()->get('old_imageSmall')) {
                $members->deleteItemImage(request()->get('old_imageSmall'));
            }
            $imageSmallName = ImageUploader::upload(request()->file('imageSmall'), $members::$imageSmallSizes);
            $members->imageSmall = $imageSmallName;
        }

        $members->saveQuietly();
    }

    /**
     * Handle the Member "deleted" event.
     *
     * @param  \App\Models\Member  $members
     * @return void
     */
    public function deleted(Member $members)
    {
        //
    }

    /**
     * Handle the Member "restored" event.
     *
     * @param  \App\Models\Member  $members
     * @return void
     */
    public function restored(Member $members)
    {
        //
    }

    /**
     * Handle the Member "force deleted" event.
     *
     * @param  \App\Models\Member  $members
     * @return void
     */
    public function forceDeleted(Member $members)
    {
        $storage = StorageDriver::instance();

        if ($members->imageSmall) {
            foreach ($members::$imageSmallSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $members->imageSmall);
                $storage->delete($path);
            }
        }

        if ($members->imageBig) {
            foreach ($members::$imageBigSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $members->imageBig);
                $storage->delete($path);
            }
        }
    }
}
