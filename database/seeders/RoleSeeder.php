<?php

namespace Database\Seeders;

use App\Models\Roles;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roles::insert([
            [ // 1
                'name' => 'super-admin',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 2
                'name' => 'admin',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 3
                'name' => 'lahta-data',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 4
                'name' => 'treasury-dana',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 5
                'name' => 'it-ops',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 6
                'name' => 'unfeature',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
        ]);
    }
}
