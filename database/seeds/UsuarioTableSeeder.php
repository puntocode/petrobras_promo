<?php

use Illuminate\Database\Seeder;

class UsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('users')->insert([
            'name'      => 'Alejandro Peralta',
            'email'     => 'aleperalta@capitanlott.com',
            'password'  => bcrypt('admin123456'),
            'created_at' => new \Datetime(),
            'updated_at' => new \Datetime(),
        ]);

        DB::table('users')->insert([
            'name'      => 'Andres Ayala',
            'email'     => 'andres.ayala@nextar.com.py',
            'password'  => bcrypt('andres.ayala2021'),
            'created_at' => new \Datetime(),
            'updated_at' => new \Datetime(),
        ]);

        DB::table('users')->insert([
            'name'      => 'Jose Fernandez',
            'email'     => 'jose.fernandez@capitanlott.com',
            'password'  => bcrypt('jose2021'),
            'created_at' => new \Datetime(),
            'updated_at' => new \Datetime(),
        ]);*/

        /*DB::table('users')->insert([
            'name'      => 'David Vargas',
            'email'     => 'dvargas@nextar.com.py',
            'password'  => bcrypt('david2021'),
            'created_at' => new \Datetime(),
            'updated_at' => new \Datetime(),
        ]);*/

        DB::table('users')->insert([
            'name'      => 'Ramirez',
            'email'     => 'm.ramirez@nextar.com.py',
            'password'  => bcrypt('Ramirez2021'),
            'created_at' => new \Datetime(),
            'updated_at' => new \Datetime(),
        ]);
    }
}
