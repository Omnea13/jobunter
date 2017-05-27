<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'     => str_random(10),
            'email'    => 'admin@employme.com',
            'password' => bcrypt('123456'),
            'type'     => 'admin'
        ]);
    }
}
