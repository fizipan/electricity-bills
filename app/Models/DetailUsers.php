<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailUsers extends Model
{
    // use HasFactory;
    use SoftDeletes;

    public $table = 'detail_users';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'users_id',
        'photo',
        'mobile_phone',
        'address',
        'information',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // one to one --- //
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'users_id', 'id');
    }

    public function getPhotoAttribute($value)
    {
        return url('storage/' . $value);
    }
}
