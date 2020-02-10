<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('client.index');
    }

    public function getAllClients(){
        $clients = Client::orderBy('full_name', 'asc')
                    ->select('id', DB::raw('CONCAT(first_name," ",last_name) as full_name'), 'picture')->get();

        return response(['data' => $clients]);
    }

    public function getListClients(){
        $columns = Client::$columns;
        return Client::searchPaginateAndOrder($columns);
    }

    public function getClient($id){

        $client = Client::find($id);
        return response(['data' => $client], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create');
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
            'first_name'            => 'required',
            'last_name'             => 'required',
        ]);

        //Tiene foto
        if(!empty($request->input('picture'))){
            $exploded = explode(',', $request->input('picture'));

            $decoded = base64_decode($exploded[1]);

            if(str_contains($exploded[0], 'jpeg')){
                $extension = 'jpg';
            }else{
                $extension = 'png';
            }

            $fileName = 'client-'.str_random(10).'.'.$extension;
            $path = storage_path('app/public/clients').'/'.$fileName;

            file_put_contents($path, $decoded);
        }

        Client::create([
            'picture'                   => (empty($fileName)||is_null($fileName))?'upload_image.jpg':$fileName,
            'type_identification'       => $request->input('type_identification'), 
            'identification'            => $request->input('identification'),
            'first_name'                => $request->input('first_name'),
            'last_name'                 => $request->input('last_name'),
            'phone_number'              => $request->input('phone_number'),
            'phone_movil'               => $request->input('phone_movil'),
            'email'                     => $request->input('email'),
            'birthday'                  => $request->input('birthday'),
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
        $client = Client::findOrFail($id);

        return view('client.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);

        return view('client.edit', compact('client'));
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
            'first_name'            => 'required',
            'last_name'             => 'required',
        ]);

        $client = Client::find($id);

        //Va a actualizar la foto de perfil
        if(!empty($request->input('picture'))){

            $exploded = explode(',', $request->input('picture'));

            $decoded = base64_decode($exploded[1]);

            if(str_contains($exploded[0], 'jpeg')){
                $extension = 'jpg';
            }else{
                $extension = 'png';
            }

            $fileName = 'client-'.str_random(10).'.'.$extension;
            $path = storage_path('app/public/clients').'/'.$fileName;

            file_put_contents($path, $decoded);

            //changed to add the zero
            chmod($path, 0777);  

            /** Borrar foto usuario anterior */
            if($client->picture != 'upload_image.jpg'){
                Storage::disk('public')->delete('/clients/'.$client->picture);
            }

        }

        $client->picture                    = (!empty($request->input('picture')))? $fileName : $client->picture;
        $client->type_identification        = $request->input('type_identification');
        $client->identification             = $request->input('identification');
        $client->first_name                 = $request->input('first_name');
        $client->last_name                  = $request->input('last_name');
        $client->phone_number               = $request->input('phone_number');
        $client->phone_movil                = $request->input('phone_movil');
        $client->email                      = $request->input('email');
        $client->birthday                   = $request->input('birthday');

        $client->save();

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
        $client = Client::find($id);
        $clientDestroy = $client->delete();

        return response(['data' => $clientDestroy], 200);
    }
}
