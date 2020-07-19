<?php

use Illuminate\Database\Seeder;
use App\Packaging;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UserSeeder::class);
        DB::table('employees')->insert([
            'name' => 'Dayini',
            'email' => 'd@gmail.com',
            'password' => Hash::make('123'),
            'phone' => '0123',
            'role' => 'Admin',
        ]);

        
    }
}
