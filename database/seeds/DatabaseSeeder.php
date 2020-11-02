<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MembresiasTableSeeder::class);
        $this->call(PasarelasTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(MesesTableSeeder::class);
        $this->call(InmueblesSeeder::class);
        $this->call(PlanPagoTableSeeder::class);
        //$this->call(ResidentesTableSeeder::class);
        $this->call(DiasTableSeeder::class);
    }
}
