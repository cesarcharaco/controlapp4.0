<?php

use Illuminate\Database\Seeder;

class InmueblesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //registrando pago comun
        for ($j=1; $j <= 12; $j++) { 
            \DB::table('pagos_comunes')->insert([
                'tipo' => 'Inmueble',
                'mes' => $j,
                'anio' => 2020,
                'monto' => 10,
                'id_admin' => 1
            ]);
        }


    	for ($i=0; $i < 10; $i++) { 
	        \DB::table('inmuebles')->insert([
	        	'idem' => 'Inmueble'.$i,
	        	'tipo' => 'Casa',
	        	'Status' => 'Disponible',
	        	'estacionamiento' => 'No',
	        	'id_admin' => 1
	        ]);
    	}
        for ($m=1; $m <= 10; $m++) { 
            for ($k=1; $k <= 12; $k++) { 
                \DB::table('mensualidades')->insert([
                    'id_inmueble' => $m,
                    'mes' => $k,
                    'anio' => 2020,
                    'monto' => 10
                ]);
            }
        }
    }
}
