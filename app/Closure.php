<?php

namespace App;

use Carbon\Carbon;
use App\EloquentVueTables;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Closure extends Model
{
    use SoftDeletes, EloquentVueTables;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cash', 'date_closure'
    ];


    public static $columns = [
        'id', 'cash', 'date_closure'
    ];

}
