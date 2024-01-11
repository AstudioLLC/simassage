<?php

namespace App\Observers\Admin;

use App\Models\Administrator;
use App\Models\Directorate;
use App\Services\ImageUploader\Drivers\StorageDriver;
use App\Services\ImageUploader\ImageUploader;
use Illuminate\Support\Arr;

class Administrators
{

    public function created(Administrator $directorate)
    {

        if (request()->file('image')) {
            if (request()->get('old_image')) {
                $directorate->deleteItemImage(request()->get('old_image'));
            }
            $imageBigName = ImageUploader::upload(request()->file('image'), $directorate::$imageBigSizes);
            $directorate->image = $imageBigName;
        }

        $directorate->saveQuietly();
    }


    public function updated(Administrator $directorate)
    {
        if (request()->file('image')) {
            if (request()->get('old_image')) {
                $directorate->deleteItemImage(request()->get('old_image'));
            }
            $imageBigName = ImageUploader::upload(request()->file('image'), $directorate::$imageBigSizes);
            $directorate->image = $imageBigName;
        }

        $directorate->saveQuietly();
    }


    public function deleted(Administrator $members)
    {
        //
    }


    public function restored(Administrator $members)
    {
        //
    }

//    /**
//     * Handle the Member "force deleted" event.
//     *
//     * @param  \App\Models\Member  $members
//     * @return void
//     */
//    public function forceDeleted(Member $members)
//    {
//        $storage = StorageDriver::instance();
//
//        if ($members->imageSmall) {
//            foreach ($members::$imageSmallSizes as $sizeData) {
//                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $members->imageSmall);
//                $storage->delete($path);
//            }
//        }
//
//        if ($members->imageBig) {
//            foreach ($members::$imageBigSizes as $sizeData) {
//                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $members->imageBig);
//                $storage->delete($path);
//            }
//        }
//    }
}
