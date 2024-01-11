<?php


namespace App\Services\ImageUploader;


use App\Services\ImageUploader\Drivers\ImageDriver;
use App\Services\ImageUploader\Drivers\StorageDriver;
use App\Services\Support\Str;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Intervention\Image\Constraint;
use Intervention\Image\Image;

/**
 * Class ImageUploader
 * @package App\Services\ImageUploader
 */
class Uploader
{
    /**
     * Allowed mime types
     * @var array
     */
    protected static $allowedMimes = [
        'image/jpeg',
        'image/svg+xml',
        'image/png',
        'image/x-icon',
        'image/ico',
        'image/icon',
        'text/ico',
        'image/webp',
        'application/ico',
        'image/vnd.microsoft.icon',
    ];

    /**
     * @var ImageDriver
     */
    protected $imageDriver;

    /**
     * @var StorageDriver
     */
    protected $storageDriver;

    /**
     * @var array|false[]
     */
    protected $config = [
        'generateName' => false,
        'generatedNameLength' => 32
    ];

    /**
     * Uploader constructor.
     * @param ImageDriver $imageDriver
     * @param FilesystemAdapter $storageDriver
     * @param array $config
     */
    public function __construct(ImageDriver $imageDriver, FilesystemAdapter $storageDriver, $config = [])
    {
        $this->imageDriver = $imageDriver;
        $this->storageDriver = $storageDriver;

        $this->config = array_merge($this->config, $config);
    }

    /**
     * @param UploadedFile $imageSource
     * @param array $sizes
     * @param null $background
     * @return null|string
     */
    public function upload(UploadedFile $imageSource, array $sizes = [], $background = null)
    {

        if (!in_array($imageSource->getMimeType(), self::$allowedMimes)) {
            return null;
        }

        $extension = $imageSource->extension();

        if ($extension === 'jpeg') {
            $extension = 'jpg';
        }
        $extension = 'webp';
//        $originalImage = $this->imageDriver->make($imageSource);

        $name = $this->generateName($imageSource, $extension);

//        $this->storageDriver->put(sprintf('%s/%s/%s', Arr::get($sizes, 'entityPath', ''), 'original', $name), $originalImage->encode($extension, 80));

        foreach ($sizes as $sizeData) {
            $originalImage = $this->imageDriver->make($imageSource);

            if (empty($sizeData['width']) && empty($sizeData['height']) && $sizeData['path']) {
                continue;
            }

            $thumbnailImage = $this->generateThumbnail($originalImage, $sizeData['width'] ?? null, $sizeData['height'] ?? null, $background);

            $this->storageDriver->put(sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $name), $thumbnailImage->encode($extension, 80));

        }

        return $name;
    }

    protected function generateName(UploadedFile $imageSource = null, $extension = 'jpg')
    {
        if (!empty($this->config['generateName'])) {
            $name = Str::random(Arr::get($this->config, 'generatedNameLength', 32));
        } else {
            $generatedName = substr(Str::slug(pathinfo($imageSource->getClientOriginalName())['filename']), 0, 32);

            $name = strtolower(Str::random(4) . '-' . $generatedName);
        }

        return $name . '.' . $extension;
    }

    /**
     * @param Image $originalImage
     * @param null $width
     * @param null $height
     * @param null $background
     * @return Image
     */
    protected function generateThumbnail(Image $originalImage, $width = null, $height = null, $background = null)
    {
        $canvas = $this->imageDriver->canvas($width, $height, $background);

        $originalWidth = $originalImage->getWidth();
        $originalHeight = $originalImage->getHeight();

        $resizeWidth = $width;
        $resizeHeight = $height;

        if ($originalWidth >= $originalHeight) {
            $resizeHeight = null;
        } else {
            $resizeWidth = null;
        }
        if ($originalWidth > $resizeWidth || $originalHeight > $resizeHeight) {
            $originalImage = $originalImage->resize($resizeWidth, $resizeHeight, function (Constraint $constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            });
        }

        return $canvas->insert($originalImage, 'center');
    }
}
