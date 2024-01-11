<?php

namespace App\Observers\Admin;

use App\Models\Fundraiser;
use App\Services\ImageUploader\Drivers\StorageDriver;
use App\Services\ImageUploader\ImageUploader;
use Illuminate\Support\Arr;

class FundraiserObserver
{
    /**
     * Handle the Fundraiser "created" event.
     *
     * @param  \App\Models\Fundraiser  $fundraiser
     * @return void
     */
    public function created(Fundraiser $fundraiser)
    {
        $fundraiser->ordering = $fundraiser->sortValue();

        if (request()->file('imageBig')) {
            if (request()->get('old_imageBig')) {
                $fundraiser->deleteItemImage(request()->get('old_imageBig'));
            }
            $imageBigName = ImageUploader::upload(request()->file('imageBig'), $fundraiser::$imageBigSizes);
            $fundraiser->imageBig = $imageBigName;
        }

        if (request()->file('imageSmall')) {
            if (request()->get('old_imageSmall')) {
                $fundraiser->deleteItemImage(request()->get('old_imageSmall'));
            }
            $imageSmallName = ImageUploader::upload(request()->file('imageSmall'), $fundraiser::$imageSmallSizes);
            $fundraiser->imageSmall = $imageSmallName;
        }

        $fundraiser->saveQuietly();
    }

    /**
     * Handle the Fundraiser "updated" event.
     *
     * @param  \App\Models\Fundraiser  $fundraiser
     * @return void
     */
    public function updated(Fundraiser $fundraiser)
    {
        if (request()->file('imageBig')) {
            if (request()->get('old_imageBig')) {
                $fundraiser->deleteItemImage(request()->get('old_imageBig'));
            }
            $imageBigName = ImageUploader::upload(request()->file('imageBig'), $fundraiser::$imageBigSizes);
            $fundraiser->imageBig = $imageBigName;
        }

        if (request()->file('imageSmall')) {
            if (request()->get('old_imageSmall')) {
                $fundraiser->deleteItemImage(request()->get('old_imageSmall'));
            }
            $imageSmallName = ImageUploader::upload(request()->file('imageSmall'), $fundraiser::$imageSmallSizes);
            $fundraiser->imageSmall = $imageSmallName;
        }

        $fundraiser->saveQuietly();
    }

    /**
     * Handle the Fundraiser "deleted" event.
     *
     * @param  \App\Models\Fundraiser  $fundraiser
     * @return void
     */
    public function deleted(Fundraiser $fundraiser)
    {
        //
    }

    /**
     * Handle the Fundraiser "restored" event.
     *
     * @param  \App\Models\Fundraiser  $fundraiser
     * @return void
     */
    public function restored(Fundraiser $fundraiser)
    {
        //
    }

    /**
     * Handle the Fundraiser "force deleted" event.
     *
     * @param  \App\Models\Fundraiser  $fundraiser
     * @return void
     */
    public function forceDeleted(Fundraiser $fundraiser)
    {
        $storage = StorageDriver::instance();

        if ($fundraiser->imageSmall) {
            foreach ($fundraiser::$imageSmallSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $fundraiser->imageSmall);
                $storage->delete($path);
            }
        }

        if ($fundraiser->imageBig) {
            foreach ($fundraiser::$imageBigSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $fundraiser->imageBig);
                $storage->delete($path);
            }
        }
    }
}
