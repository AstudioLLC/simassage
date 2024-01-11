<?php


namespace App\Services\ImageUploader;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Facade;

/**
 * Class ImageUploader
 * @package App\Services\ImageUploader
 *
 * @method static string upload($imageSource, array $sizes = [], $background = null)
 */
class ImageUploader extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'imageUploader';
    }
}
