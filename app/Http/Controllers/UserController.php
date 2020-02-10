<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index');
    }


    public function getListUsers(){
        $columns = User::$columns;
        return User::searchPaginateAndOrder($columns);
    }

    public function getUser($id){
        //$user = User::findOrFail($id);

        $user = User::find($id);

        return response(['data' => $user], 200);
    }

    public function getAllUsers(){
        $users = User::where('profile', 'manager')
                    ->orderBy('username', 'asc')
                    ->select('id', 'username', 'picture')->get();

        return response(['data' => $users]);
    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
            'username'              => 'required',
            'email'                 => 'required|email|unique:users',
            'first_name'            => 'required',
            'last_name'             => 'required',
            'profile'               => 'required',
            'password'              => 'required|min:6',
            'password_confirm'      => 'required|same:password'
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

            $fileName = 'user-'.str_random(10).'.'.$extension;
            $path = storage_path('app/public/users').'/'.$fileName;

            file_put_contents($path, $decoded);

        }

        User::create([
            'picture'                   => (empty($fileName)||is_null($fileName))?'upload_image.jpg':$fileName,
            'username'                  => $request->input('username'), 
            'email'                     => $request->input('email'),
            'first_name'                => $request->input('first_name'),
            'last_name'                 => $request->input('last_name'),
            'profile'                   => $request->input('profile'),
            'password'                  => $request->input('password'),
        ]);

        //User::create($request->all());

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
        $user = User::findOrFail($id);

        //dd($user);

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('user.edit', compact('user'));
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
            'username'              => 'required',
            'first_name'            => 'required',
            'last_name'             => 'required',
        ]);


        $user = User::find($id);

        //Va a actualizar la foto de perfil
        if(!empty($request->input('picture'))){

            $exploded = explode(',', $request->input('picture'));

            $decoded = base64_decode($exploded[1]);

            if(str_contains($exploded[0], 'jpeg')){
                $extension = 'jpg';
            }else{
                $extension = 'png';
            }

            $fileName = 'user-'.str_random(10).'.'.$extension;
            $path = storage_path('app/public/users').'/'.$fileName;

            file_put_contents($path, $decoded);

            //changed to add the zero
            chmod($path, 0777);  

            /** Borrar foto usuario anterior */
            if($user->picture != 'upload_image.jpg'){
                Storage::disk('public')->delete('/users/'.$user->picture);
            }

        }

        $user->picture      = (!empty($request->input('picture')))? $fileName : $user->picture;
        $user->username     = $request->input('username');
        $user->first_name   = $request->input('first_name');
        $user->last_name    = $request->input('last_name');

        $user->save();

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
        $user = User::find($id);

        $userDestroy = $user->delete();

        return response(['data' => $userDestroy], 200);
    }
}
