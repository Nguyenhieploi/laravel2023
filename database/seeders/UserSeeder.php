<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
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
        // DataseSeed sẽ là thư mục goc để goi các seeder con, thay vì phải chạy trực tiep vào nó
        User::factory()->count(1000)->create();
    }
}
