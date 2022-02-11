<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupRate extends Model
{
    // use HasFactory;
    use SoftDeletes;

    public $table = 'group_rate';
    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // One to many
    public function rate()
    {
        return $this->hasMany('App\Models\MasterData\Rate', 'group_rate_id', 'id');
    }
}
