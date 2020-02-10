<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies_categories', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('movie_id')->nullable();
            /*$table->foreign('movie_id')
              ->references('id')->on('movies')
              ->onDelete('cascade');*/


            $table->unsignedInteger('category_id')->nullable();
            /*$table->foreign('category_id')
              ->references('id')->on('categories')
              ->onDelete('cascade');*/
            
            
              $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies_categories');
    }
}
