<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id'); //clave primaria de la tabla 'categories'

            $table->string('name', 128);
            $table->string('slug', 128)->unique(); //url amigable. Tiene que tener igual tamaño que 'name'
                                                //Category General 5.5 = Category-General-5-5 (igual tamaño) 
            $table->mediumText('body')->nullable();
            
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
        Schema::dropIfExists('categories');
    }
}
