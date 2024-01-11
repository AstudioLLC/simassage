<?php

namespace App\Observers\Admin;


use App\Models\Price;
use App\Services\ImageUploader\Drivers\StorageDriver;
use App\Services\ImageUploader\ImageUploader;
use Illuminate\Support\Arr;

class PriceObserver
{
    /**
     * Handle the Price "created" event.
     *
     * @param  \App\Models\Price  $service
     * @return void
     */
    public function created(Price $price)
    {
        $price->ordering = $price->sortValue();

        if (request()->file('imageBig')) {
            if (request()->get('old_imageBig')) {
                $price->deleteItemImage(request()->get('old_imageBig'));
            }
            $imageBigName = ImageUploader::upload(request()->file('imageBig'), $price::$imageBigSizes);
            $price->imageBig = $imageBigName;
        }

        if (request()->file('imageSmall')) {
            if (request()->get('old_imageSmall')) {
                $price->deleteItemImage(request()->get('old_imageSmall'));
            }
            $imageSmallName = ImageUploader::upload(request()->file('imageSmall'), $price::$imageSmallSizes);
            $price->imageSmall = $imageSmallName;
        }

        if (request()->file('imageSmallSecond')) {
            if (request()->get('old_imageSmallSecond')) {
                $price->deleteItemImage(request()->get('old_imageSmallSecond'));
            }
            $imageSmallSecondName = ImageUploader::upload(request()->file('imageSmallSecond'), $price::$imageSmallSizes);
            $price->imageSmallSecond = $imageSmallSecondName;
        }

        $price->saveQuietly();
    }

    /**
     * Handle the Price "updated" event.
     *
     * @param  \App\Models\Price  $price
     * @return void
     */
    public function updated(Price $price)
    {
        if (request()->file('imageBig')) {
            if (request()->get('old_imageBig')) {
                $price->deleteItemImage(request()->get('old_imageBig'));
            }
            $imageBigName = ImageUploader::upload(request()->file('imageBig'), $price::$imageBigSizes);
            $price->imageBig = $imageBigName;
        }

        if (request()->file('imageSmall')) {
            if (request()->get('old_imageSmall')) {
                $price->deleteItemImage(request()->get('old_imageSmall'));
            }
            $imageSmallName = ImageUploader::upload(request()->file('imageSmall'), $price::$imageSmallSizes);
            $price->imageSmall = $imageSmallName;
        }

        if (request()->file('imageSmallSecond')) {
            if (request()->get('old_imageSmallSecond')) {
                $price->deleteItemImage(request()->get('old_imageSmallSecond'));
            }
            $imageSmallSecondName = ImageUploader::upload(request()->file('imageSmallSecond'), $price::$imageSmallSizes);
            $price->imageSmallSecond = $imageSmallSecondName;
        }

        $price->saveQuietly();
    }

    /**
     * Handle the Price "deleted" event.
     *
     * @param  \App\Models\Price  $price
     * @return void
     */
    public function deleted(Price $price)
    {
        //
    }

    /**
     * Handle the Price "restored" event.
     *
     * @param  \App\Models\Price  $price
     * @return void
     */
    public function restored(Price $price)
    {
        //
    }

    /**
     * Handle the Price "force deleted" event.
     *
     * @param  \App\Models\Price  $price
     * @return void
     */
    public function forceDeleted(Price $price)
    {
        $storage = StorageDriver::instance();

        if ($price->imageSmall) {
            foreach ($price::$imageSmallSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $price->imageSmall);
                $storage->delete($path);
            }
        }


        if ($price->imageSmallSecond) {
            foreach ($price::$imageSmallSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $price->imageSmallSecond);
                $storage->delete($path);
            }
        }

        if ($price->imageBig) {
            foreach ($price::$imageBigSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $price->imageBig);
                $storage->delete($path);
            }
        }
    }
}
