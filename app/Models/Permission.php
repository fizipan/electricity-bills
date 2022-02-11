<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    // use HasFactory;
    use SoftDeletes;

    public $table = 'permissions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'menus_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // many to many --- //
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // one to many --- //
    public function menus()
    {
        return $this->belongsTo('App\Models\Menus', 'menus_id', 'id');
    }
}
