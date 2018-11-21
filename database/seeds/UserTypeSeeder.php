<?php

use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('user_types')->truncate();
        
        DB::table('user_types')->insert([
            'nombre' => 'encargado',
        ]);

        DB::table('user_types')->insert([
            'nombre' => 'empleado',
        ]);

        DB::table('user_types')->insert([
            'nombre' => 'cliente',
        ]);
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
