<?php

use Illuminate\Database\Seeder;

class PlanPagoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('planes_pago')->insert([
			'nombre' => 'Plan Nro. 1',
			'monto' => '30',
			'dias' => '7',
			'nombre_img' => 'Reloj1-2.png',
			'url_img' => 'assets/images/anuncios/Reloj1-2.png',
			'color' => '#25c2e3',
			'tipo' => 'Anuncio',
			'status' => 'Activo'
        ]);

        \DB::table('planes_pago')->insert([
            'nombre' => 'Plan Nro. 2',
            'monto' => '70',
            'dias' => '14',
            'nombre_img' => 'Reloj2-2.png',
            'url_img' => 'assets/images/anuncios/Reloj2-2.png',
            'color' => '#ffbe0b',
            'tipo' => 'Anuncio',
            'status' => 'Activo'
        ]);

        \DB::table('planes_pago')->insert([
            'nombre' => 'Plan Nro. 3',
            'monto' => '100',
            'dias' => '30',
            'nombre_img' => 'Reloj3-2.png',
            'url_img' => 'assets/images/anuncios/Reloj3-2.png',
            'color' => '#ff5c75',
            'tipo' => 'Anuncio',
            'status' => 'Activo'
        ]);



         \DB::table('planes_pago')->insert([
            'nombre' => 'Plan Nro. 1-2',
            'monto' => '30',
            'dias' => '7',
            'nombre_img' => 'Reloj1-2.png',
            'url_img' => 'assets/images/anuncios/Reloj1-2.png',
            'color' => '#25c2e3',
            'tipo' => 'Alquiler',
            'status' => 'Activo'
        ]);

        \DB::table('planes_pago')->insert([
            'nombre' => 'Plan Nro. 2-2',
            'monto' => '70',
            'dias' => '14',
            'nombre_img' => 'Reloj2-2.png',
            'url_img' => 'assets/images/anuncios/Reloj2-2.png',
            'color' => '#ffbe0b',
            'tipo' => 'Alquiler',
            'status' => 'Activo'
        ]);

        \DB::table('planes_pago')->insert([
            'nombre' => 'Plan Nro. 3-2',
            'monto' => '100',
            'dias' => '30',
            'nombre_img' => 'Reloj3-2.png',
            'url_img' => 'assets/images/anuncios/Reloj3-2.png',
            'color' => '#ff5c75',
            'tipo' => 'Alquiler',
            'status' => 'Activo'
        ]);
    }
}
