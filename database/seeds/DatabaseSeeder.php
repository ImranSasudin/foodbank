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
        // $this->call(UserSeeder::class);
        DB::table('employees')->insert([
            'name' => 'Imran',
            'email' => 'imran@gmail.com',
            'password' => Hash::make('123'),
            'phone' => '0123',
            'role' => 'Admin',
        ]);
    }
}
