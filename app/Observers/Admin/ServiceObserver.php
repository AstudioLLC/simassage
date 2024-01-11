<?php

namespace App\Observers\Admin;


use App\Models\Service;
use App\Services\ImageUploader\Drivers\StorageDriver;
use App\Services\ImageUploader\ImageUploader;
use Illuminate\Support\Arr;

class ServiceObserver
{
    /**
     * Handle the Service "created" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function created(Service $service)
    {
        $service->ordering = $service->sortValue();

        if (request()->file('imageBig')) {
            if (request()->get('old_imageBig')) {
                $service->deleteItemImage(request()->get('old_imageBig'));
            }
            $imageBigName = ImageUploader::upload(request()->file('imageBig'), $service::$imageBigSizes);
            $service->imageBig = $imageBigName;
        }

        if (request()->file('imageSmall')) {
            if (request()->get('old_imageSmall')) {
                $service->deleteItemImage(request()->get('old_imageSmall'));
            }
            $imageSmallName = ImageUploader::upload(request()->file('imageSmall'), $service::$imageSmallSizes);
            $service->imageSmall = $imageSmallName;
        }

        if (request()->file('imageSmallSecond')) {
            if (request()->get('old_imageSmallSecond')) {
                $service->deleteItemImage(request()->get('old_imageSmallSecond'));
            }
            $imageSmallSecondName = ImageUploader::upload(request()->file('imageSmallSecond'), $service::$imageSmallSizes);
            $service->imageSmallSecond = $imageSmallSecondName;
        }

        $service->saveQuietly();
    }

    /**
     * Handle the Service "updated" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function updated(Service $service)
    {
        if (request()->file('imageBig')) {
            if (request()->get('old_imageBig')) {
                $service->deleteItemImage(request()->get('old_imageBig'));
            }
            $imageBigName = ImageUploader::upload(request()->file('imageBig'), $service::$imageBigSizes);
            $service->imageBig = $imageBigName;
        }

        if (request()->file('imageSmall')) {
            if (request()->get('old_imageSmall')) {
                $service->deleteItemImage(request()->get('old_imageSmall'));
            }
            $imageSmallName = ImageUploader::upload(request()->file('imageSmall'), $service::$imageSmallSizes);
            $service->imageSmall = $imageSmallName;
        }

        if (request()->file('imageSmallSecond')) {
            if (request()->get('old_imageSmallSecond')) {
                $service->deleteItemImage(request()->get('old_imageSmallSecond'));
            }
            $imageSmallSecondName = ImageUploader::upload(request()->file('imageSmallSecond'), $service::$imageSmallSizes);
            $service->imageSmallSecond = $imageSmallSecondName;
        }

        $service->saveQuietly();
    }

    /**
     * Handle the Service "deleted" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function deleted(Service $service)
    {
        //
    }

    /**
     * Handle the Service "restored" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function restored(Service $service)
    {
        //
    }

    /**
     * Handle the Service "force deleted" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function forceDeleted(Service $service)
    {
        $storage = StorageDriver::instance();

        if ($service->imageSmall) {
            foreach ($service::$imageSmallSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $service->imageSmall);
                $storage->delete($path);
            }
        }


        if ($service->imageSmallSecond) {
            foreach ($service::$imageSmallSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $service->imageSmallSecond);
                $storage->delete($path);
            }
        }

        if ($service->imageBig) {
            foreach ($service::$imageBigSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $service->imageBig);
                $storage->delete($path);
            }
        }
    }
}
