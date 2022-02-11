<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogsActivities extends Model
{
    // use HasFactory;
    use SoftDeletes;

    public $table = 'logs_activities';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'users_id',
        'name',
        'email',
        'full_url',
        'method',
        'client_ip',
        'status_code',
        'response',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'users_id', 'id');
    }
}
