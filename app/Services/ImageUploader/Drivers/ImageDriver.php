<?php
/**
 * Created by PhpStorm.
 * User: pogho
 * Date: 5/19/2019
 * Time: 1:40 AM
 */

namespace App\Services\ImageUploader\Drivers;

use Intervention\Image\ImageManager as Image;


/**
 * Class ImageDriver
 * @package App
 */
class ImageDriver extends Image
{
    /**
     * Instance of image driver
     * @var self
     */
    public static $instance;

    /**
     * Image driver
     * @var string
     */
    public static $driver;

    /**
     * @param string $driver
     * @return ImageDriver
     */
    public static function instance($driver = 'gd')
    {
        if (!self::$driver || !self::$driver != $driver) {
            self::$driver = $driver;
            self::$instance = new self(['driver' => self::$driver]);
        }

        return self::$instance;
    }
}
