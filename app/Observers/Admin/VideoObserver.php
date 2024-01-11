<?php

namespace App\Observers\Admin;

use App\Models\Video;
use App\Services\ImageUploader\Drivers\StorageDriver;
use Illuminate\Support\Arr;

class VideoObserver
{
    /**
     * Handle the Video "created" event.
     *
     * @param  \App\Models\Video  $video
     * @return void
     */
    public function created(Video $video)
    {
        $video->ordering = $video->sortValue();
        if (request()->file('name')) {
            if (request()->get('old_name')) {
                $video->deleteItemImage(request()->get('old_name'));
            }
            $videoName = upload_file(request()->file('name'), 'app/public/media/'.$video::$imagePath.'thumbnail', request()->get('old_name') ? request()->get('old_name') : false);
            $video->name = $videoName;
        }

        $video->saveQuietly();
    }

    /**
     * Handle the Video "updated" event.
     *
     * @param  \App\Models\Video  $video
     * @return void
     */
    public function updated(Video $video)
    {
        if (request()->file('name')) {
            $videoName = upload_file(request()->file('name'), 'app/public/media/'.$video::$imagePath.'thumbnail', request()->get('old_name') ? request()->get('old_name') : false);
            $video->name = $videoName;
        }

        $video->saveQuietly();
    }

    /**
     * Handle the Video "deleted" event.
     *
     * @param  \App\Models\Video  $video
     * @return void
     */
    public function deleted(Video $video)
    {
        if ($video->name) {
            $storage = StorageDriver::instance();
            foreach ($video::$imageSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $video->name);
                $storage->delete($path);
            }
        }
    }

    /**
     * Handle the Video "restored" event.
     *
     * @param  \App\Models\Video  $video
     * @return void
     */
    public function restored(Video $video)
    {
        //
    }

    /**
     * Handle the Video "force deleted" event.
     *
     * @param  \App\Models\Video  $video
     * @return void
     */
    public function forceDeleted(Video $video)
    {
        //
    }
}
