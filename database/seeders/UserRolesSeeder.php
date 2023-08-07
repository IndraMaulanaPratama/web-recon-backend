<?php

namespace Database\Seeders;

use App\Models\UsersRoles;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UsersRoles::insert([
            [
                // Role Super Admin
                'role' => 1,
                'user' => 1,
            ],
            [
                // Role Admin
                'role' => 2,
                'user' => 2,
            ],
            [
                // Role Treasury Dana
                'role' => 3,
                'user' => 3,
            ],
            [
                // Role Lahta Data
                'role' => 4,
                'user' => 4,
            ],
            [
                // Role IT OPS
                'role' => 5,
                'user' => 5,
            ],
            [
                // Role Indra Maulana
                'role' => 1,
                'user' => 6,
            ],
            [
                // Role Unfeature
                'role' => 6,
                'user' => 7,
            ],
            [
                // Role Yandi
                'role' => 1,
                'user' => 8,
            ],
        ]);
    }
}
