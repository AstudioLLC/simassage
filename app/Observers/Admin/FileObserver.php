<?php

namespace App\Observers\Admin;

use App\Models\File;
use App\Services\ImageUploader\Drivers\StorageDriver;
use App\Services\ImageUploader\ImageUploader;
use Illuminate\Support\Arr;

class FileObserver
{
    /**
     * Handle the File "created" event.
     *
     * @param  \App\Models\File  $file
     * @return void
     */
    public function created(File $file)
    {
        $file->ordering = $file->sortValue();
        if (request()->file('name')) {
            if (request()->get('old_name')) {
                $file->deleteItemImage(request()->get('old_name'));
            }
            $fileName = upload_file(request()->file('name'), 'app/public/media/'.$file::$imagePath.'thumbnail', request()->get('old_name') ? request()->get('old_name') : false);
            $file->name = $fileName;
        }

        if (request()->file('imageBig')) {
            
            if (request()->get('old_imageBig')) {
                $file->deleteItemImage(request()->get('old_imageBig'));
            }
            $imageBigName = ImageUploader::upload(request()->file('imageBig'), $file::$imageBigSizes);
            $file->imageBig = $imageBigName;
        }

        if (request()->file('imageSmall')) {
            if (request()->get('old_imageSmall')) {
                $file->deleteItemImage(request()->get('old_imageSmall'));
            }
            $imageSmallName = ImageUploader::upload(request()->file('imageSmall'), $file::$imageSmallSizes);
            $file->imageSmall = $imageSmallName;
        }

        $file->saveQuietly();
    }

    /**
     * Handle the File "updated" event.
     *
     * @param  \App\Models\File  $file
     * @return void
     */
    public function updated(File $file)
    {
        if (request()->file('name')) {
            /*if (request()->get('old_name')) {
                $file->deleteItemImage(request()->get('old_name'));
            }*/
            $fileName = upload_file(request()->file('name'), 'app/public/media/'.$file::$imagePath.'thumbnail', request()->get('old_name') ? request()->get('old_name') : false);
            $file->name = $fileName;
        }

        if (request()->file('imageBig')) {
            if (request()->get('old_imageBig')) {
                $file->deleteItemImage(request()->get('old_imageBig'));
            }
            $imageBigName = ImageUploader::upload(request()->file('imageBig'), $file::$imageBigSizes);
            $file->imageBig = $imageBigName;
        }

        if (request()->file('imageSmall')) {
            if (request()->get('old_imageSmall')) {
                $file->deleteItemImage(request()->get('old_imageSmall'));
            }
            $imageSmallName = ImageUploader::upload(request()->file('imageSmall'), $file::$imageSmallSizes);
            $file->imageSmall = $imageSmallName;
        }

        $file->saveQuietly();
    }

    /**
     * Handle the File "deleted" event.
     *
     * @param  \App\Models\File  $file
     * @return void
     */
    public function deleted(File $file)
    {
        if ($file->name) {
            $storage = StorageDriver::instance();
            foreach ($file::$imageSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $file->name);
                $storage->delete($path);
            }
        }

        if ($file->imageBig) {
            $storage = StorageDriver::instance();
            foreach ($file::$imageBigSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $file->imageBig);
                $storage->delete($path);
            }
        }

        if ($file->imageSmall) {
            $storage = StorageDriver::instance();
            foreach ($file::$imageSmallSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $file->imageSmall);
                $storage->delete($path);
            }
        }
    }

    /**
     * Handle the File "restored" event.
     *
     * @param  \App\Models\File  $file
     * @return void
     */
    public function restored(File $file)
    {
        //
    }

    /**
     * Handle the File "force deleted" event.
     *
     * @param  \App\Models\File  $file
     * @return void
     */
    public function forceDeleted(File $file)
    {
        //
    }
}
