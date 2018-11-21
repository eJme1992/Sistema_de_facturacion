<?php

use Illuminate\Database\Seeder;

class OrderTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('orders_type')->truncate();
        
        DB::table('orders_type')->insert([
            'nombre' => 'productos',
        ]);

        DB::table('orders_type')->insert([
            'nombre' => 'servicios',
        ]);
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
