<?php

namespace App\Models;

use App\Services\ImageUploader\Drivers\StorageDriver;
use App\Services\ImageUploader\ImageUploader;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class FilesImage extends AbstractModel
{
    public $timestamps = false;

    /**
     * @var array[]
     */
    public static $imageSmallSizes = [
        [
            'width' => 480,
            'height' => 416,
            'entityPath' => 'files_images',
            'size' => 'thumbnail',
        ]
    ];

    /**
     * @var array[]
     */
    public static $imageBigSizes = [
        [
            'width' => 829,
            'height' => 622,
            'entityPath' => 'files_images',
            'size' => 'thumbnail',
        ]
    ];

    /**
     * @param $id
     * @return mixed
     */
    public static function getItem($id)
    {
        $result = self::where('id', $id)->first();
        if (!$result) abort(404);

        return $result;
    }

    /**
     * @param $inputs
     * @return bool
     */
    public static function action($inputs)
    {
        if (request()->file('imageSmall')) {
            $imageSmall = self::query()->where(['file_id' => $inputs['key'], 'file_type' => 'imageSmall'])->get();
            if (count($imageSmall)) {
                self::deleteItemImage($action = 'edit', $imageSmall[0]->name);
            }
;           $imageSmallModel = new self;
            $imageSmallModel->file_id = $inputs['key'];
            $imageSmallModel->file_type = 'imageSmall';
            $imageName = ImageUploader::upload(request()->file('imageSmall'), static::$imageSmallSizes);
            $imageSmallModel->name = $imageName;
            $imageSmallModel->save();
        }

        if (request()->file('imageBig')) {
            $imageBig = self::query()->where(['file_id' => $inputs['key'], 'file_type' => 'imageBig'])->get();
            if (count($imageBig)) {
                self::deleteItemImage($action = 'edit', $imageBig[0]->name);
            }
            $imageBigModel = new self;
            $imageBigModel->file_id = $inputs['key'];
            $imageBigModel->file_type = 'imageBig';
            //self::deleteItemImage($action, $model->name);
            $imageName = ImageUploader::upload(request()->file('imageBig'), static::$imageBigSizes);
            $imageBigModel->name = $imageName;
            $imageBigModel->save();
        }
    }

    /**
     * @param $model
     * @return mixed
     */
    public static function deleteItem($model)
    {
        $storage = StorageDriver::instance();

        foreach (static::$imageSmallSizes as $sizeData) {
            $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $model->image);
            $storage->delete($path);
        }

        foreach (static::$imageBigSizes as $sizeData) {
            $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $model->image);
            $storage->delete($path);
        }

        return $model->delete();
    }

    /**
     * @param $action
     * @param $image
     */
    public static function deleteItemImage($action, $image)
    {
        if ($action == 'edit' && !empty($image)){
            $storage = StorageDriver::instance();

            foreach (static::$imageSmallSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $image);
                $storage->delete($path);
            }

            foreach (static::$imageBigSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $image);
                $storage->delete($path);
            }
        }
    }

    /**
     * @param string $size
     * @return string
     */
    public function getImageUrl($size = ''): string
    {
        if (!$this->name) {
            return '';
        }

        $size = '/news/' . $size;

        return asset(sprintf('storage/media%s/%s', $size, $this->name));
    }
}
