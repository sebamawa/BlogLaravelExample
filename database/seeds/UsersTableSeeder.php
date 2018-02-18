<?php

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
        factory(App\User::class, 29)->create(); //creo 29 usuarios falsos
        //el usuario 30 es para porder loguearse (pues los anteriores estan creados con datos falsos)
        App\User::create([
            'name' => 'Sebastian Martinez',
            'email' => 'sebamawa@hotmail.com',
            'password' => bcrypt('123')
        ]);
    }
}
