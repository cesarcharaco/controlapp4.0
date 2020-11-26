<?php

use Illuminate\Database\Seeder;

class MembresiasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('membresias')->insert([
            'url_imagen' => 'assets/images/membresia_base.jpg',
        	'nombre' => 'Base',
        	'cant_inmuebles' => '50',
        	'monto' => '0'
        ]);

        \DB::table('membresias')->insert([
            'url_imagen' => 'assets/images/membresia_media.jpg',
        	'nombre' => 'Media',
        	'cant_inmuebles' => '100',
        	'monto' => '15'
        ]);

        \DB::table('membresias')->insert([
            'url_imagen' => 'assets/images/membresia_plus.jpg',
        	'nombre' => 'Plus',
        	'cant_inmuebles' => '200',
        	'monto' => '25'
        ]);
    }
}
