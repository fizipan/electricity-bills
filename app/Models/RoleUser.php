<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    // use HasFactory;
    // use SoftDeletes;

    public $table = 'role_user';
    public $timestamps = false;

    // protected $dates = [
    //     'created_at',
    //     'updated_at',
    //     'deleted_at',
    // ];

    protected $guarded = [
        'user_id',
        'role_id',
    ];

    // one to many --- //
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function role()
    {
        return $this->belongsTo('App\Role', 'role_id', 'id');
    }
}
