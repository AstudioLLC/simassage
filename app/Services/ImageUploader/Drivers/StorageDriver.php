<?php

namespace App\Services\ImageUploader\Drivers;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage as BaseStorage;

/**
 * Class Storage
 * @package App
 */
class StorageDriver extends BaseStorage
{
    /**
     * Instance of storage
     * @var self
     */
    public static $instance;

    /**
     * Disk of storage
     * @var string
     */
    public static $disk;

    /**
     * @param string $disk
     * @return StorageDriver|Filesystem
     */
    public static function instance($disk = 'media')
    {
        if (!self::$disk || !self::$disk != $disk) {
            self::$disk = $disk;
            self::$instance = self::disk(self::$disk);
        }

        return self::$instance;
    }
}
