<?php

namespace App\Models\Operational;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    // use HasFactory;
    use SoftDeletes;

    public $table = 'customer';
    public $timestamps = true;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'users_id',
        'code',
        'no_meter',
        'rate_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // One to one
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'users_id', 'id');
    }

    public function rate()
    {
        return $this->belongsTo('App\Models\MasterData\Rate', 'rate_id', 'id');
    }

    // One to many
    public function customer_usage()
    {
        return $this->hasMany('App\Models\Operational\CustomerUsage', 'customer_id', 'id');
    }

    public function transaction()
    {
        return $this->hasMany('App\Models\Operational\Transaction', 'customer_id', 'id');
    }


    
    
}
