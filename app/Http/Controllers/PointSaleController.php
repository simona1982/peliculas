<?php

namespace App\Http\Controllers;

use App\PointSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PointSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('point_sale.index');
    }

    public function getAllPoints(){
        $points = PointSale::orderBy('name', 'asc')
                    ->select('id', 'name', 'picture')->get();

        return response(['data' => $points]);
    }


    public function getPoint($id){

        $point = PointSale::find($id);

        if($point->has('user')){
            $point->push($point->user);
            //response(['data' => $point], 200);
        }

        return response(['data' => $point], 200);
    }


    public function getListPointsSales(){
        $columns = PointSale::$columns;
        return PointSale::searchPaginateAndOrder($columns);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('point_sale.create');
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
            'name'                  => 'required',
            'sistemaPos'            => 'required',
            'location'              => 'required',
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

            $fileName = 'point-'.str_random(10).'.'.$extension;
            $path = storage_path('app/public/points').'/'.$fileName;

            file_put_contents($path, $decoded);

        }


        PointSale::create([
            'picture'                   => (empty($fileName)||is_null($fileName))?'upload_image.jpg':$fileName,
            'name'                      => $request->input('name'), 
            'sistemaPos'                => $request->input('sistemaPos'),
            'location'                  => $request->input('location'),
            'user_id'                   => (empty('user_id')||is_null('user_id'))? null: $request->input('user_id'),
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
        $point = PointSale::findOrFail($id);


        return view('point_sale.show', compact('point'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $point = PointSale::findOrFail($id);

        return view('point_sale.edit', compact('point'));
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
        $this->validate($request, [
            'name'                  => 'required',
            'sistemaPos'            => 'required',
            'location'              => 'required',
        ]);


        $point = PointSale::find($id);

        //Va a actualizar la foto de perfil
        if(!empty($request->input('picture'))){

            $exploded = explode(',', $request->input('picture'));

            $decoded = base64_decode($exploded[1]);

            if(str_contains($exploded[0], 'jpeg')){
                $extension = 'jpg';
            }else{
                $extension = 'png';
            }

            $fileName = 'point-'.str_random(10).'.'.$extension;
            $path = storage_path('app/public/points').'/'.$fileName;

            file_put_contents($path, $decoded);

            //changed to add the zero
            chmod($path, 0777);  

            /** Borrar foto usuario anterior */
            if($point->picture != 'upload_image.jpg'){
                Storage::disk('public')->delete('/points/'.$point->picture);
            }

        }

        $point->picture      = (!empty($request->input('picture')))? $fileName : $point->picture;
        $point->name         = $request->input('name');
        $point->sistemaPos   = ($request->input('sistemaPos') == true)? 1: 0;
        $point->location     = $request->input('location');
        $point->user_id      = (empty($request->input('user_id'))||is_null($request->input('user_id')))? null: $request->input('user_id');

        $point->save();

        return response(['message' => 'ok'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $point = PointSale::find($id);

        $pointDestroy = $point->delete();

        return response(['data' => $pointDestroy], 200);
    }
}
