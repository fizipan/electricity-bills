<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    // use HasFactory;
    use SoftDeletes;

    public $table = 'transaction';
    public $timestamps = true;

    protected $dates = [
        'date_pay',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'customer_usage_id',
        'code',
        'date_pay',
        'total_meter',
        'total_price',
        'status',
        'photo',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // One to many
    public function customer_usage()
    {
        return $this->belongsTo('App\Models\Operational\CustomerUsage', 'customer_usage_id', 'id');
    }
}
