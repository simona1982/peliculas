<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');

            $table->string('picture')->nullable();
            $table->enum('type_identification', ['cc', 'ce', 'passport', 'nit']);
            $table->string('identification');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number')->nullable();
            $table->string('phone_movil')->nullable();
            $table->string('email')->nullable();
            $table->date('birthday');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
