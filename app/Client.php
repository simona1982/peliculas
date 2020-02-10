<?php

namespace App;

use Carbon\Carbon;
use App\EloquentVueTables;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use SoftDeletes, EloquentVueTables;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'picture', 'type_identification', 'identification', 'first_name', 'last_name', 'phone_number', 'phone_movil', 'email', 'birthday'
    ];


    public static $columns = [
        'id', 'type_identification', 'identification', 'first_name', 'last_name', 'phone_number', 'phone_movil', 'email', 
        'deleted_at', 'birthday'];


    protected $dates = ['birthday'];

    public function setBirthdayAttribute($date){
        $this->attributes['birthday'] = Carbon::parse($date);
    }

}
