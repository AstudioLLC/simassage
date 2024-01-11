<?php

namespace App\Models;

use App\Traits\HasTranslations;
use App\Traits\Sortable;
use App\Traits\UrlUnique;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends AbstractModel
{
    use HasTranslations, Sortable, UrlUnique, SoftDeletes;

    /**
     * @var bool
     */
    protected $sortableDesc = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'title',
        'position',
        'name_of_department',
        'url',
        'imageBig',
        'short',
        'content',
        'active',
        'show_home',
        'ordering',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @var string[]
     */
    public $translatable = [
        'title',
        'short',
        'content',
        'position',
        'name_of_department',
    ];

    /**
     * @var array[]
     */
    public static $imageSizes = [
        [
            'width' => 1,
            'height' => 1,
            'entityPath' => 'Members',
            'size' => 'thumbnail'
        ]
    ];

    /**
     * @var string
     */
    public static $imagePath = '/Members/';

    /**
     * @var array[]
     */
    public static $imageBigSizes = [
        [
            'width' => 344,
            'height' => 462,
            'entityPath' => 'Members',
            'size' => 'thumbnail',
        ]
    ];

    public function videos()
    {
        return $this->hasMany(Video::class, 'key')->where('video', 'members')->orderBy('ordering', 'asc');
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class, 'key')->where('gallery', 'members')->orderBy('ordering', 'asc');
    }

    public function department()
    {
        return $this->hasMany(MembersCategory::class, 'members_id');
    }


    public function createMemberCategory(array $ids)
    {
        $this->deleteOldDataCategory();
        array_map([$this, 'insertCategory'], $ids);

    }

    private function insertCategory($department_id): void
    {
        MembersCategory::insert([
            'department_id' => $department_id,
            'members_id' => $this->id,
        ]);
    }

    private function deleteOldDataCategory() : void
    {
        MembersCategory::where('members_id',$this->id)->delete();
    }


}
