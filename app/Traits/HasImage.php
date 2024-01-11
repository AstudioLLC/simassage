<?php


namespace App\Traits;


use App\Models\Image;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Trait HasImage
 * @package App\Traits
 *
 * @property string $name
 */
trait HasImage
{
    /**
     * @return MorphOne
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable', 'model_type', 'model_id');
    }

    /**
     * @param string $size
     * @return string
     */
    public function getImageUrl($size = ''): string
    {
        if (!$this->image) {
            return '';
        }

        $size = '/' . $size;

        return asset(sprintf('storage/media%s/%s', $size, $this->image->name));
    }
}
