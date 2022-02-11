<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rate extends Model
{
    // use HasFactory;
    use SoftDeletes;

    public $table = 'rate';
    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'group_rate_id',
        'code',
        'power',
        'rate_power',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    // One to one
    public function customer()
    {
        return $this->hasOne('App\Models\Operational\Customer', 'rate_id', 'id');
    }

    // One to many
    public function group_rate()
    {
        return $this->belongsTo('App\Models\MasterData\GroupRate', 'group_rate_id', 'id');
    }
}
