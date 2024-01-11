<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Sortable;

class QueuingStatus extends AbstractModel
{
    use HasFactory,Sortable;

    /**
     * @var string
     */
    protected $table = 'queuing_statuses';

    /**
     * @var bool
     */

    protected $sortableDesc = false;

    protected $fillable = [
        'id',
        'name',
        'ordering',
        'created_at',
        'updated_at'
    ];

    public function messages()
    {
        return $this->hasMany(QueuingMessage::class, 'status_id');
    }
}
