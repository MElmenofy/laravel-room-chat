<?php

namespace Database\Seeders;

use App\Models\User;
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
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'elmenofy',
            'email' => 'elmenofym8@gmail.com',
            'image' => '6.png',
            'password' => bcrypt('123123123'),
        ]);
    }
}
