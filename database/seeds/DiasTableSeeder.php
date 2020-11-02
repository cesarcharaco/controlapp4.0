<?php

use Illuminate\Database\Seeder;

class DiasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('dias')->insert(['dia' => 'Lunes']);
        \DB::table('dias')->insert(['dia' => 'Martes']);
        \DB::table('dias')->insert(['dia' => 'Miércoles']);
        \DB::table('dias')->insert(['dia' => 'Jueves']);
        \DB::table('dias')->insert(['dia' => 'Viernes']);
        \DB::table('dias')->insert(['dia' => 'Sábado']);
        \DB::table('dias')->insert(['dia' => 'Domingo']);
    }
}
