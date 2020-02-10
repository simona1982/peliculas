<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');

            $table->string('description');
            $table->string('picture')->nullable();
            $table->unsignedInteger('client_id');
            $table->unsignedInteger('point_id');

            $table->date('reservation_date');
            $table->time('reservation_time');

            $table->string('phone');
            $table->string('movil');
            $table->string('email');
            $table->unsignedTinyInteger('quantity');
            $table->boolean('decoration');

            $table->foreign('client_id')
              ->references('id')->on('clients')
              ->onDelete('cascade');

            $table->foreign('point_id')
              ->references('id')->on('point_sales')
              ->onDelete('cascade');

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
        Schema::dropIfExists('reservations');
    }
}
