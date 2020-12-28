<?php

use Illuminate\Database\Seeder;

class PasarelasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('pasarelas')->insert([
            'pasarela' => 'Flow'
        ]);
        \DB::table('pasarelas')->insert([
            'pasarela' => 'TransBank'
        ]);
        \DB::table('pasarelas')->insert([
            'pasarela' => 'Webpay'
        ]);
        \DB::table('pasarelas')->insert([
            'pasarela' => 'MercadoPago'
        ]);
        \DB::table('pasarelas')->insert([
            'pasarela' => 'Paypal'
        ]);
        \DB::table('pasarelas')->insert([
            'pasarela' => 'PagoFácil'
        ]);
        \DB::table('pasarelas')->insert([
            'pasarela' => 'Khipu'
        ]);
        \DB::table('pasarelas')->insert([
            'pasarela' => 'Kushki'
        ]);
        \DB::table('pasarelas')->insert([
            'pasarela' => 'Stripe'
        ]);
        \DB::table('pasarelas')->insert([
            'pasarela' => 'PayU Latam'
        ]);
    }
}
