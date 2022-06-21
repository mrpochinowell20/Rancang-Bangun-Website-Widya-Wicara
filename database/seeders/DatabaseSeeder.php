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
        User::create([
        'username' => "admin",
        'name' => "admin",
        'level' => "admin",
        'password' => bcrypt('12345')
        ]);

        User::create([
            'username' => "sadmin",
            'name' => "sadmin",
            'level' => "super_admin",
            'password' => bcrypt('12345')
            ]);
    }
}
