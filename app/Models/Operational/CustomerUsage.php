<?php

namespace App\Models\Operational;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerUsage extends Model
{
    // use HasFactory;
    use SoftDeletes;

    public $table = 'customer_usage';
    public $timestamps = true;

    protected $dates = [
        'date_usage',
        'date_check',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'customer_id',
        'date_usage',
        'start_meter',
        'end_meter',
        'date_check',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    // One to many
    public function customer()
    {
        return $this->belongsTo('App\Models\Operational\Customer', 'customer_id', 'id');
    }

    public function transaction()
    {
        return $this->hasMany('App\Models\Transaction\Transaction', 'customer_usage_id', 'id');
    }
}
