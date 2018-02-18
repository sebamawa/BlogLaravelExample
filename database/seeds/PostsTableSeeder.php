<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\Post::class, 300)->create(); //crea 300 posts

        //crea 300 posts y a cada uno le asigna 3 etiquetas (relacion N-N)
        //esto permite sembrar la tabla post-tag, si bien esta no tiene Seeder asociado
        //$post es el objeto que se crea actualmente
        factory(App\Post::class, 300)->create()->each(function(App\Post $post) {
            //invoco funcion tags() definida en el modelo Post:
            /**
             *     public function tags() {
             *          return $this->belongToMany(Tag::class);
             *       }
             */
            $post->tags()->attach([
                rand(1, 5),
                rand(6, 14),
                rand(15, 20)
            ]);
        });
    }
}
