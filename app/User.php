<?php

namespace App;

use App\EloquentVueTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, EloquentVueTables;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'picture', 'username', 'email', 'password', 'first_name', 'last_name', 'profile'
    ];


    public static $columns = ['id', 'username', 'email', 'first_name', 'last_name', 'deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    public function setPasswordAttribute($pass){

        $this->attributes['password'] = Hash::make($pass);

    }


    /**
     * Get the point record associated with the user.
     */
    public function point()
    {
        return $this->hasOne('App\PointSale');
    }
}
