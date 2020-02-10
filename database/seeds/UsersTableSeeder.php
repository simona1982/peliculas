<?php

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::create([
            'picture'        => 'upload_image.jpg',
    		'username' 		 => 'avelasquez',
            'email' 		 => 'monkey.velasquez.1982@gmail.com',
            'password' 		 => 'Joker1982',//bcrypt('Joker1982'),
            'first_name'     => 'Andres',
            'last_name'      => 'Velasquez Delgado',
            'profile'        => 'manager',
            'remember_token' => str_random(10),
    	]);

        factory(App\User::class, 49)->create();
    }
}
