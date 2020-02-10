<?php

namespace App;

use App\EloquentVueTables;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PointSale extends Model
{
    use SoftDeletes, EloquentVueTables;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'picture', 'name', 'sistemaPos', 'location', 'user_id'
    ];


    public static $columns = ['id', 'name', 'sistemaPos', 'location', 'user_id', 'deleted_at'];


    /**
     * Get the user that owns the point.
     */
    public function user(){
        return $this->belongsTo('App\User');
    }

}
