<?php

namespace Database\Seeders;

use App\Models\User;
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
        $user = new User();
        $user->username = "admin";
        $user->name = "admin";
        $user->level = "admin";
        $user->password = bcrypt('12345');
        $user->save();

        $user = new User();
        $user->username = "sadmin";
        $user->name = "sadmin";
        $user->level = "super_admin";
        $user->password = bcrypt('12345');
        $user->save();

    }
}
