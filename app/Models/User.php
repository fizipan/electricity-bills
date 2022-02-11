<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    public $table = 'users';

    public $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
        'remember_token',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    // protected $appends = [
    //     'profile_photo_url',
    // ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::created(function (User $user) {
            $registrationRole = config('panel.registration_default_role');

            if (!$user->roles()->get()->contains($registrationRole)) {
                $user->roles()->attach($registrationRole);
            }
        });
    }

    // many to many --- //
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // for config
    public function logs_activities()
    {
        return $this->hasMany('App\Models\Config\LogsActivities', 'users_id');
    }

    //  one to one --- //
    public function detail_users()
    {
        return $this->hasOne('App\Models\DetailUsers', 'users_id');
    }

    public function customer()
    {
        return $this->hasOne('App\Models\Operational\Customer', 'users_id');
    }

    public function customer_usage()
    {
        return $this->hasMany('App\Models\Operational\CustomerUsage', 'customer_id');
    }

    // one to many --- //
    public function role_user()
    {
        return $this->hasMany('App\Models\RoleUser', 'user_id');
    }
}
