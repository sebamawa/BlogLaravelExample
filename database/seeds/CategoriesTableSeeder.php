<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ejecuta el Factory del modelo asociado
        factory(App\Category::class, 20)->create(); //crea 20 categorias
    }
}
