<?php

namespace App\Observers\Admin;

use App\Models\File;
use App\Models\Gallery;
use App\Models\Page;
use App\Services\ImageUploader\Drivers\StorageDriver;
use App\Services\ImageUploader\ImageUploader;
use Illuminate\Support\Arr;

class PageObserver
{
    /**
     * Handle the Page "created" event.
     *
     * @param  \App\Models\Page  $page
     * @return void
     */
    public function created(Page $page)
    {
        $page->ordering = $page->sortValue();
        if (request()->file('image')) {
            if (request()->get('old_image')) {
                $page->deleteItemImage(request()->get('old_image'));
            }
            if ($page->id == 1){
                $imageSizes = $page::$imageSizesHome;
            }elseif ($page->id == 48){
                $imageSizes = $page::$imageSizesAbout;
            }elseif ($page->id == 63){
                $imageSizes = $page::$imageGalleryPage;
            } elseif ($page->parent_id == 67){
                $imageSizes = $page::$imageSizesServices;
            }elseif ($page->parent_id == 1){
                $imageSizes = $page::$imageSizesInformation;
            }elseif ($page->parent_id == 60){
                $imageSizes = $page::$imageSizesInformation;
            }else{
                $imageSizes = $page::$imageSizes;
            }
            $imageName = ImageUploader::upload(request()->file('image'), $imageSizes);
            $page->image = $imageName;
        }

        if (request()->file('icon')) {
            if (request()->get('old_icon')) {
                $page->deleteItemImage(request()->get('old_icon'));
            }
            if ($page->parent_id == 67){
                $iconName = ImageUploader::upload(request()->file('icon'), $page::$iconSizesStructure);
                $page->icon = $iconName;
            }else{
                $iconName = ImageUploader::upload(request()->file('icon'), $page::$iconSizes);
                $page->icon = $iconName;
            }
        }

        $page->saveQuietly();
    }

    /**
     * Handle the Page "updated" event.
     *
     * @param  \App\Models\Page  $page
     * @return void
     */
    public function updated(Page $page)
    {
        if (request()->file('image')) {
            if (request()->get('old_image')) {
                $page->deleteItemImage(request()->get('old_image'));
            }
            if ($page->id == 1){
                $imageSizes = $page::$imageSizesHome;
            }elseif ($page->id == 48){
                $imageSizes = $page::$imageSizesAbout;
            }elseif ($page->id == 63){
                $imageSizes = $page::$imageGalleryPage;
            }elseif ($page->id == 34){
                $imageSizes = $page::$imageSizesInformation;
            }elseif ($page->parent_id == 67){
                $imageSizes = $page::$imageSizesServices;
            }elseif ($page->parent_id == 1){
                $imageSizes = $page::$imageSizesInformation;
            }elseif ($page->parent_id == 60){
                $imageSizes = $page::$imageSizesInformation;
            }else{
                $imageSizes = $page::$imageSizes;
            }

            $imageName = ImageUploader::upload(request()->file('image'), $imageSizes);

            $page->image = $imageName;
        }
        if ($page->id == 48){
            if (request()->file('icon')) {
                if (request()->get('old_icon')) {
                    $page->deleteItemImage(request()->get('old_icon'));
                }
                $iconName = ImageUploader::upload(request()->file('icon'), $page::$imageSizesAbout);
                $page->icon = $iconName;
            }
        }else{
            if (request()->file('icon')) {
                if (request()->get('old_icon')) {
                    $page->deleteItemImage(request()->get('old_icon'));
                }
                if ($page->parent_id == 67){
                    $iconSizes = $page::$iconSizesStructure;
                }else{
                    $iconSizes = $page::$iconSizes;
                }
                $iconName = ImageUploader::upload(request()->file('icon'), $iconSizes);
                $page->icon = $iconName;
            }
        }

        $page->saveQuietly();
    }

    /**
     * Handle the Page "deleted" event.
     *
     * @param  \App\Models\Page  $page
     * @return void
     */
    public function deleted(Page $page)
    {
        //
    }

    /**
     * Handle the Page "restored" event.
     *
     * @param  \App\Models\Page  $page
     * @return void
     */
    public function restored(Page $page)
    {
        //
    }

    /**
     * Handle the Page "force deleted" event.
     *
     * @param  \App\Models\Page  $page
     * @return void
     */
    public function forceDeleted(Page $page)
    {
        $storage = StorageDriver::instance();

        if ($page->image) {
            foreach ($page::$imageSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $page->image);
                $storage->delete($path);
            }
        }

        if ($page->icon) {
            foreach ($page::$iconSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $page->icon);
                $storage->delete($path);
            }
        }

        $galleryQuery = $page->gallery();
        $gallery = $page->gallery()->get();
        if (count($gallery)) {
            foreach ($gallery as $item) {
                if ($item->image) {
                    foreach (Gallery::$imageSizes as $sizeData) {
                        $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $item->image);
                        $storage->delete($path);
                    }
                }
            }
            $galleryQuery->delete();
        }

        $fileQuery = $page->files();
        $files = $page->gallery()->get();
        if (count($files)) {
            foreach ($files as $item) {
                if ($item->name) {
                    foreach (File::$imageSizes as $sizeData) {
                        $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $item->name);
                        $storage->delete($path);
                    }
                }

                if ($item->imageSmall) {
                    foreach (File::$imageSmallSizes as $sizeData) {
                        $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $item->imageSmall);
                        $storage->delete($path);
                    }
                }

                if ($item->imageBig) {
                    foreach (File::$imageBigSizes as $sizeData) {
                        $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $item->imageBig);
                        $storage->delete($path);
                    }
                }
            }
            $fileQuery->delete();
        }
    }
}
