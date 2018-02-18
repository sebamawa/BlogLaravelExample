<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned(); //un post tiene un usuario. No negativo
            $table->integer('category_id')->unsigned(); //un post tiene (le pertence a) una categoria
            $table->string('name', 128); //titulo del post
            $table->string('slug', 128)->unique();
            $table->mediumText('excerpt')->nullable(); //excerpt=extracto
            $table->text('body'); //contenido del post
            $table->enum('status', ['PUBLISHED', 'DRAFT'])->default('DRAFT'); //DRAFT=Borrador
            $table->string('file', 128)->nullable(); //imagen del post opcional

            $table->timestamps();

            //Table Relations

            //El campo 'user_id' hace referencia al campo 'id' de la tabla 'users'
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade') //Indica que si se elimina un usuario se van a eliminar
            ->onUpdate('cascade');  //todos los posts de ese usuario

            $table->foreign('category_id')->references('id')->on('categories')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
