<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
          // Tạo một người dùng cho chính bạn
          DB::table('users')->insert([
            'name' => 'loinguyen',
            'email' => 'nguyenhieploi2001z@gmail.com',
            'password' => Hash::make('password'),
        ]);

        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
        ]);
    }
}
