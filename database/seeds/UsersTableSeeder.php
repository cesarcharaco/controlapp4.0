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
        \DB::table('users_admin')->insert([
            'name' => 'Administrador1',
            'rut' => '123456789',
            'email' => 'admin1@controlnice.cl',
            'id_membresia' => 3,
            'created_at' => '2020-12-01 20:04:15'
        ]);

        \DB::table('users')->insert([
        	'name' => 'Administrador1',
            'rut' => '123456789',
        	'email' => 'admin1@controlnice.cl',
        	'password' => bcrypt('EICHE_CONTROL'),
            'tipo_usuario' => 'Admin'
        ]);

        \DB::table('residentes')->insert([
            'nombres' => 'Administrador1',
            'apellidos' => 'Admin',
            'rut' => '123456789',
            'id_usuario' => 1,
            'id_admin' => 1
        ]);

        /*\DB::table('users')->insert([
            'name' => 'Francisco Carpio',
            'rut' => '121212121',
            'email' => 'franciscocarpio@controlapp.cl',
            'password' => bcrypt('EICHE_CONTROL'),
            'tipo_usuario' => 'Residente'
        ]);*/

        /*\DB::table('users')->insert([
            'name' => 'María Garcia',
            'rut' => '121212145',
            'email' => 'mariagarcia@controlapp.cl',
            'password' => bcrypt('EICHE_CONTROL'),
            'tipo_usuario' => 'Otro'
        ]);*/

        \DB::table('users')->insert([
            'name' => 'Root',
            'rut' => '1232212212',
            'email' => 'root@controlnice.cl',
            'password' => bcrypt('EICHE_CONTROL'),
            'tipo_usuario' => 'root'
        ]);

    }
}
