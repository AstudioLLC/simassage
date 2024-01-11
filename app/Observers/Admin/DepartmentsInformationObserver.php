<?php

namespace App\Observers\Admin;

use App\Models\DepartmentsInformation;
use App\Services\ImageUploader\Drivers\StorageDriver;
use App\Services\ImageUploader\ImageUploader;
use Illuminate\Support\Arr;

class DepartmentsInformationObserver
{
    /**
     * Handle the DepartmentsInformation "created" departmentsInformation.
     *
     * @param  \App\Models\DepartmentsInformation  $departmentsInformation
     * @return void
     */
    public function created(DepartmentsInformation $departmentsInformation)
    {
        $departmentsInformation->ordering = $departmentsInformation->sortValue();

        if (request()->file('imageBig')) {
            if (request()->get('old_imageBig')) {
                $departmentsInformation->deleteItemImage(request()->get('old_imageBig'));
            }
            $imageBigName = ImageUploader::upload(request()->file('imageBig'), $departmentsInformation::$imageBigSizes);
            $departmentsInformation->imageBig = $imageBigName;
        }

        if (request()->file('imageSmall')) {
            if (request()->get('old_imageSmall')) {
                $departmentsInformation->deleteItemImage(request()->get('old_imageSmall'));
            }
            $imageSmallName = ImageUploader::upload(request()->file('imageSmall'), $departmentsInformation::$imageSmallSizes);
            $departmentsInformation->imageSmall = $imageSmallName;
        }

        $departmentsInformation->saveQuietly();
    }

    /**
     * Handle the DepartmentsInformation "updated" departmentsInformation.
     *
     * @param  \App\Models\DepartmentsInformation  $departmentsInformation
     * @return void
     */
    public function updated(DepartmentsInformation $departmentsInformation)
    {
        if (request()->file('imageBig')) {
            if (request()->get('old_imageBig')) {
                $departmentsInformation->deleteItemImage(request()->get('old_imageBig'));
            }
            $imageBigName = ImageUploader::upload(request()->file('imageBig'), $departmentsInformation::$imageBigSizes);
            $departmentsInformation->imageBig = $imageBigName;
        }

        if (request()->file('imageSmall')) {
            if (request()->get('old_imageSmall')) {
                $departmentsInformation->deleteItemImage(request()->get('old_imageSmall'));
            }
            $imageSmallName = ImageUploader::upload(request()->file('imageSmall'), $departmentsInformation::$imageSmallSizes);
            $departmentsInformation->imageSmall = $imageSmallName;
        }

        $departmentsInformation->saveQuietly();
    }

    /**
     * Handle the DepartmentsInformation "deleted" departmentsInformation.
     *
     * @param  \App\Models\DepartmentsInformation  $departmentsInformation
     * @return void
     */
    public function deleted(DepartmentsInformation $departmentsInformation)
    {
        //
    }

    /**
     * Handle the DepartmentsInformation "restored" departmentsInformation.
     *
     * @param  \App\Models\DepartmentsInformation  $departmentsInformation
     * @return void
     */
    public function restored(DepartmentsInformation $departmentsInformation)
    {
        //
    }

    /**
     * Handle the DepartmentsInformation "force deleted" departmentsInformation.
     *
     * @param  \App\Models\DepartmentsInformation  $departmentsInformation
     * @return void
     */
    public function forceDeleted(DepartmentsInformation $departmentsInformation)
    {
        $storage = StorageDriver::instance();

        if ($departmentsInformation->imageSmall) {
            foreach ($departmentsInformation::$imageSmallSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $departmentsInformation->imageSmall);
                $storage->delete($path);
            }
        }

        if ($departmentsInformation->imageBig) {
            foreach ($departmentsInformation::$imageBigSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $departmentsInformation->imageBig);
                $storage->delete($path);
            }
        }
    }
}
