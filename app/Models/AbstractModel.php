<?php


namespace App\Models;

use App\Services\ImageUploader\Drivers\StorageDriver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

/**
 * Class AbstractModel
 * @package App\Models
 *
 * @method static AbstractModel|Builder sort
 */
abstract class AbstractModel extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function scopeSort($query)
    {
        return $query->orderBy('id', 'asc');
    }

    public function fillRequest(Request $request)
    {
        return $this->fill($request->except('_token'))->save();
    }

    public static function deleteEntity(int $id)
    {
        return static::query()->where('id', $id)->delete();
    }

    public static function getIncrement()
    {
        $model = new static();
        $database = $model->getConnection()->getDatabaseName();
        $table = $model->getTable();

        return DB::select("SELECT `AUTO_INCREMENT` as `increment` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$database' AND TABLE_NAME = '$table'")[0]->increment;
    }

    /**
     * @param $image
     */
    public static function deleteItemImage($image)
    {
        if (!empty($image)){
            $storage = StorageDriver::instance();

            foreach (static::$imageSizes as $sizeData) {
                $path = sprintf('%s/%s/%s', Arr::get($sizeData, 'entityPath', ''), Arr::get($sizeData, 'size', ''), $image);
                $storage->delete($path);
            }
        }
    }

    public function getImageUrl($size = '', $image = null)
    {

        if ($image) {
            $imageName = $image;
        } else {
            if ($this->image) {
                $imageName = $this->image;
            } else {
                return '';
            }
        }
        $size = static::$imagePath . $size;

        return asset(sprintf('storage/media%s/%s', $size, $imageName));

    }
}
