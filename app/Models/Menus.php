<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menus extends Model
{
    // use HasFactory;
    use SoftDeletes;

    public $table = 'menus';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'information',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // one to many --- //
    public function permissions()
    {
        return $this->hasMany('App\Models\Permissions', 'menus_id');
    }
}
