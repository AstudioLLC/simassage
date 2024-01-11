<?php

namespace App\Observers\Admin;

use App\Models\News;
use App\Services\ImageUploader\Drivers\StorageDriver;
use App\Services\ImageUploader\ImageUploader;
use Illuminate\Support\Arr;

class NewsObserver
{
    /**
     * Handle the News "created" event.
     *
     * @param  \App\Models\News  $news
     * @return void
     */
    public function created(News $news)
    {
        $news->ordering = $news->sortValue();

        if (request()->file('imageBig')) {
            if (request()->get('old_imageBig')) {
                $news->deleteItemImage(request()->get('old_imageBig'));
            }
            $imageBigName = ImageUploader::upload(request()->file('imageBig'), $news::$imageBigSizes);
            $news->imageBig = $imageBigName;
        }

        if (request()->file('imageSmall')) {
            if (request()->get('old_imageSmall')) {
                $news->deleteItemImage(request()->get('old_imageSmall'));
            }
            $imageSmallName = ImageUploader::upload(request()->file('imageSmall'), $news::$imageSmallSizes);
            $news->imageSmall = $imageSmallName;
        }

        if (request()->file('imageSmallSecond')) {
            if (request()->get('old_imageSmallSecond')) {
                $news->deleteItemImage(request()->get('old_imageSmallSecond'));
            }
            $imageSmallSecondName = ImageUploader::upload(request()->file('imageSmallSecond'), $news::$imageSmallSizes);
            $news->imageSmallSecond = $imageSmallSecondName;
        }

        $news->saveQuietly();
    }

    /**
     * Handle the News "updated" event.
     *
     * @param  \App\Models\News  $news
     * @return void
     */
    public function updated(News $news)
    {
        if (request()->file('imageBig')) {
            if (request()->get('old_imageBig')) {
                $news->deleteItemImage(request()->get('old_imageBig'));
            }
            $imageBigName = ImageUploader::upload(request()->file('imageBig'), $news::$imageBigSizes);
            $news->imageBig = $imageBigName;
        }

        if (request()->file('imageSmall')) {
            if (request()->get('old_imageSmall')) {
                $news->deleteItemImage(request()->get('old_imageSmall'));
            }
            $imageSmallName = ImageUploader::upload(request()->file('imageSmall'), $news::$imageSmallSizes);
            $news->imageSmall = $imageSmallName;
        }

        if (request()->file('imageSmallSecond')) {
            if (request()->get('old_imageSmallSecond')) {
                $news->deleteItemImage(request()->get('old_imageSmallSecond'));
            }
            $imageSmallSecondName = ImageUploader::upload(request()->file('imageSmallSecond'), $news::$imageSmallSizes);
            $news->imageSmallSecond = $imageSmallSecondName;
        }

        $news->saveQuietly();
    }

    /**
     * Handle the News "deleted" event.
     *
     * @param  \App\Models\News  $news
     * @return void
     */
    public function deleted(News $news)
    {
        //
    }

    /**
     * Handle the News "restored" event.
     *
     * @param  \App\Models\News  $news
     * @return void
     */
    public function restored(News $news)
    {
        //
    }

    /**
     * Handle the News "force deleted" event.
     *
     * @param  \App\Models\News  $news
     * @return void
     */
    public function forceDeleted(News $news)
    {
        $storage = StorageDriver::instance();

        if ($news->imageSmall) {
            foreach ($news::$imageSmallSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $news->imageSmall);
                $storage->delete($path);
            }
        }


        if ($news->imageSmallSecond) {
            foreach ($news::$imageSmallSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $news->imageSmallSecond);
                $storage->delete($path);
            }
        }

        if ($news->imageBig) {
            foreach ($news::$imageBigSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $news->imageBig);
                $storage->delete($path);
            }
        }
    }
}
