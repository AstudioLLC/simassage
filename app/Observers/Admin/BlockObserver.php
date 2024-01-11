<?php

namespace App\Observers\Admin;

use App\Models\Block;
use App\Services\ImageUploader\Drivers\StorageDriver;
use App\Services\ImageUploader\ImageUploader;
use Illuminate\Support\Arr;

class BlockObserver
{
    /**
     * Handle the Block "created" event.
     *
     * @param  \App\Models\Block  $block
     * @return void
     */
    public function created(Block $block)
    {
        $block->ordering = $block->sortValue();
        if (request()->file('image')) {
            if (request()->get('old_image')) {
                $block->deleteItemImage(request()->get('old_image'));
            }
            $imageName = ImageUploader::upload(request()->file('image'), $block::$imageSizes);
            $block->image = $imageName;
        }

        if (request()->file('icon')) {
            if (request()->get('old_icon')) {
                $block->deleteItemImage(request()->get('old_icon'));
            }
            $iconName = ImageUploader::upload(request()->file('icon'), $block::$iconSizes);
            $block->icon = $iconName;
        }

        $block->saveQuietly();
    }

    /**
     * Handle the Block "updated" event.
     *
     * @param  \App\Models\Block  $block
     * @return void
     */
    public function updated(Block $block)
    {
        if (request()->file('image')) {
            if (request()->get('old_image')) {
                $block->deleteItemImage(request()->get('old_image'));
            }
            $imageName = ImageUploader::upload(request()->file('image'), $block::$imageSizes);
            $block->image = $imageName;
        }

        if (request()->file('icon')) {
            if (request()->get('old_icon')) {
                $block->deleteItemImage(request()->get('old_icon'));
            }
            $iconName = ImageUploader::upload(request()->file('icon'), $block::$iconSizes);
            $block->icon = $iconName;
        }

        $block->saveQuietly();
    }

    /**
     * Handle the Block "deleted" event.
     *
     * @param  \App\Models\Block  $block
     * @return void
     */
    public function deleted(Block $block)
    {
        //
    }

    /**
     * Handle the Block "restored" event.
     *
     * @param  \App\Models\Block  $block
     * @return void
     */
    public function restored(Block $block)
    {
        //
    }

    /**
     * Handle the Block "force deleted" event.
     *
     * @param  \App\Models\Block  $block
     * @return void
     */
    public function forceDeleted(Block $block)
    {
        $storage = StorageDriver::instance();

        if ($block->image) {
            foreach ($block::$imageSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $block->image);
                $storage->delete($path);
            }
        }

        if ($block->icon) {
            foreach ($block::$iconSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $block->icon);
                $storage->delete($path);
            }
        }
    }
}
