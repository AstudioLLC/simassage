<?php

namespace App\Constants;

use Exception;
use Illuminate\Support\Arr;
use ReflectionClass;
use ReflectionException;

abstract class AbstractConstants
{
    /**
     * Returns type values as array json or string
     *
     * @param string $returnType
     * @param bool $translate
     * @param string $transNamespace
     * @return array|false|string
     * @throws ReflectionException
     */
    public static function all($returnType = 'string', $translate = false, $transNamespace = 'admin')
    {
        $reflection = new ReflectionClass(get_called_class());
        $constants = $reflection->getConstants();
        $flipped = array_flip($constants);

        if ($returnType == 'array') {
            if ($translate) {
                foreach ($flipped as &$value) {
                    $value = trans($transNamespace . '.constants.' . strtolower($value));
                }

                return $flipped;
            }

            return $constants;

        } elseif ($returnType == 'json') {
            if ($translate) {
                foreach ($flipped as &$value) {
                    $value = trans($transNamespace . '.constants.' . strtolower($value));
                }
            }

            return json_encode($flipped, JSON_UNESCAPED_UNICODE);
        } else {
            return implode(',', $constants);
        }
    }

    /**
     * @param string $name
     * @param bool $toLowercase
     * @return array
     * @throws ReflectionException
     */
    public static function get(string $name, $toLowercase = true)
    {
        $reflection = new ReflectionClass(get_called_class());

        $constants = $reflection->getConstants();

        if ($toLowercase) {
            $constants = array_change_key_case($reflection->getConstants(), CASE_LOWER);
        }

        return Arr::get($constants, $name, []);
    }

    /**
     * Return the key of constant by given value
     *
     * @param $value
     * @param $transNamespace
     * @param bool $translate
     *
     * @return mixed
     * @throws ReflectionException
     */
    public static function key($value, $translate = false, $transNamespace = 'admin')
    {
        $value = strtoupper($value);
        $reflection = new ReflectionClass(get_called_class());
        $constants = $reflection->getConstants();
        $flipped = array_flip($constants);

        try {
            $result = $flipped[$value];
        } catch (Exception $exception) {
            $result = '';
        }

        if ($translate) {
            $result = trans($transNamespace . '.constants.' . strtolower($result));
        }

        return $result;
    }

    /**
     * @param bool $toLowercase
     * @return array
     * @throws ReflectionException
     */
    public static function keys($toLowercase = true): array
    {
        $reflection = new ReflectionClass(get_called_class());
        $constants = array_keys($reflection->getConstants());

        if ($toLowercase) {
            $constants = array_map(function ($key) {
                return strtolower($key);
            }, $constants);
        }

        return $constants;
    }
}
