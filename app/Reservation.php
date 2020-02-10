<?php

namespace App;

use Carbon\Carbon;
use App\EloquentVueTables;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use SoftDeletes, EloquentVueTables;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'picture', 'description', 'client_id', 'point_id', 'reservation_date', 'reservation_time', 'phone', 'movil', 'email', 
        'quantity', 'decoration',
    ];

    public static $columns = [
        'id', 'description', 'phone', 'movil', 'email', 'decoration', 'quantity', 'reservation_date', 'reservation_time', 'deleted_at'
    ];

    public function setReservationDateAttribute($date){
        $this->attributes['reservation_date'] = Carbon::parse($date);
    }
}
