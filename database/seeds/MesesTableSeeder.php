<?php

use Illuminate\Database\Seeder;

class MesesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('meses')->insert(['mes' => 'Enero']);
        \DB::table('meses')->insert(['mes' => 'Febrero']);
        \DB::table('meses')->insert(['mes' => 'Marzo']);
        \DB::table('meses')->insert(['mes' => 'Abril']);
        \DB::table('meses')->insert(['mes' => 'Mayo']);
        \DB::table('meses')->insert(['mes' => 'Junio']);
        \DB::table('meses')->insert(['mes' => 'Julio']);
        \DB::table('meses')->insert(['mes' => 'Agosto']);
        \DB::table('meses')->insert(['mes' => 'Septiembre']);
        \DB::table('meses')->insert(['mes' => 'Octubre']);
        \DB::table('meses')->insert(['mes' => 'Noviembre']);
        \DB::table('meses')->insert(['mes' => 'Diciembre']);
    }
}
