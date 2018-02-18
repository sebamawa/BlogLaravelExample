<?php

use Faker\Generator as Faker;

//estructura del Factory de categorias
$factory->define(App\Category::class, function (Faker $faker) {
    $title = $faker->sentence(4); //crea oracion de 4 paralabras para el titulo
    return [
        'name' => $title,
        'slug' => str_slug($title), //convierto titulo a slug (uso helper de Laravel)
        'body' => $faker->text(500), //creo texto de 500 caracteres para el body de la categoria
    ];
});

//Nota: La estructura creada en el Factory se va a poder usar para creacion n veces en el Seeder
//En el factory se utilizan los mismos campos que de las migraciones (campos de la tabla de la bd)
