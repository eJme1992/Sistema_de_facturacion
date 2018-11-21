<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('users')->truncate();
        
        DB::table('users')->insert([
            'nombre' => 'JABlack Soft',
            'telefono' => '3854452788',
            'email' => 'info@jablacksoft.com',
            'password' => bcrypt(123),
            'direccion' => 'Sin dirección 321',
            'nacimiento' => '2000-01-01',
            'id_uType' => '1',
        ]);
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
