<?php

namespace App\Observers\Admin;

use App\Models\Slider;
use App\Services\ImageUploader\Drivers\StorageDriver;
use App\Services\ImageUploader\ImageUploader;
use Illuminate\Support\Arr;

class SliderObserver
{
    /**
     * Handle the Slider "created" event.
     *
     * @param  \App\Models\Slider  $slider
     * @return void
     */
    public function created(Slider $slider)
    {
        $slider->ordering = $slider->sortValue();
        if (request()->file('image')) {
            if (request()->get('old_image')) {
                $slider->deleteItemImage(request()->get('old_image'));
            }
            $imageName = ImageUploader::upload(request()->file('image'), $slider::$imageSizes);
            $slider->image = $imageName;
        }
        $slider->saveQuietly();
    }

    /**
     * Handle the Slider "updated" event.
     *
     * @param  \App\Models\Slider  $slider
     * @return void
     */
    public function updated(Slider $slider)
    {
        if (request()->file('image')) {
            if (request()->get('old_image')) {
                $slider->deleteItemImage(request()->get('old_image'));
            }

            $imageName = ImageUploader::upload(request()->file('image'), $slider::$imageSizes);
            $slider->image = $imageName;
            $slider->saveQuietly();
        }
    }

    /**
     * Handle the Slider "deleted" event.
     *
     * @param  \App\Models\Slider  $slider
     * @return void
     */
    public function deleted(Slider $slider)
    {
        //
    }

    /**
     * Handle the Slider "restored" event.
     *
     * @param  \App\Models\Slider  $slider
     * @return void
     */
    public function restored(Slider $slider)
    {
        //
    }

    /**
     * Handle the Slider "force deleted" event.
     *
     * @param  \App\Models\Slider  $slider
     * @return void
     */
    public function forceDeleted(Slider $slider)
    {
        $storage = StorageDriver::instance();

        if ($slider->image) {
            foreach ($slider::$imageSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $slider->image);
                $storage->delete($path);
            }
        }
    }
}
