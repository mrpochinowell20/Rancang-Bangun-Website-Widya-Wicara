<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
<<<<<<< HEAD
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
=======
        \App\Models\User::factory(10)->create();
            $this->call([
                UserCompanySeeder::class,
>>>>>>> 388432a1763e625674b434b658a551ac3fdec1b0
            ]);
    }
}
