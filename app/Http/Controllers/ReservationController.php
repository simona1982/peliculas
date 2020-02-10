<?php

namespace App\Http\Controllers;

use App\PointSale;
use App\Client;
use App\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reservation.index');
    }

    public function getListReservations(){
        $columns = Reservation::$columns;
        return Reservation::searchPaginateAndOrder($columns);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reservation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'client_id'             => 'required',
            'point_id'              => 'required',
            'reservation_time'      => 'required',
            'reservation_date'      => 'required',
            'movil'                 => 'required',
            'email'                 => 'required',
            'quantity'              => 'required',
        ]);


        //Tiene foto el punto
        if(!empty($request->input('picture'))){
            $exploded = explode(',', $request->input('picture'));

            $decoded = base64_decode($exploded[1]);

            if(str_contains($exploded[0], 'jpeg')){
                $extension = 'jpg';
            }else{
                $extension = 'png';
            }

            $fileName = 'reservation-'.str_random(10).'.'.$extension;
            $path = storage_path('app/public/reservations').'/'.$fileName;

            file_put_contents($path, $decoded);

        }

        //Obtengo el punto
        $point = PointSale::find($request->input('point_id'));
        $client = Client::find($request->input('client_id'));

        Reservation::create([
            'description'  => $point->name. ' - '.$client->first_name. ' '.$client->first_name. ' - '. $request->input('reservation_date'). ' '.$request->input('reservation_time'),
            'picture'                   => (empty($fileName)||is_null($fileName))?'upload_image.jpg':$fileName,
            'client_id'                 => $request->input('client_id'), 
            'point_id'                  => $request->input('point_id'), 
            'reservation_date'          => $request->input('reservation_date'), 
            'reservation_time'          => $request->input('reservation_time'), 
            'phone'                     => $request->input('phone'),
            'movil'                     => $request->input('movil'),
            'email'                     => $request->input('email'),
            'quantity'                  => $request->input('quantity'),
            'decoration'                => $request->input('decoration'),
        ]);


        return response(['message' => 'ok'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        $reservationDestroy = $reservation->delete();

        return response(['data' => $reservationDestroy], 200);
    }
}
