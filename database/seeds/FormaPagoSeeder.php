<?php

use Illuminate\Database\Seeder;

class FormaPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('formas_pago')->truncate();
        
        DB::table('formas_pago')->insert([
            'nombre' => 'Efectivo',
        ]);

        DB::table('formas_pago')->insert([
            'nombre' => 'Tarjeta',
        ]);

        DB::table('formas_pago')->insert([
            'nombre' => 'Eftvo | Tarj',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
