<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
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
        User::insert([
            [ // 1
                'name' => 'Super Admin',
                'username' => 'super-admin',
                'email' => 'super-admin@valuestream.id',
                'password' => '$2y$10$OHo6s45Tl9B6TXQVGMp5RunGPLnImVQGXTuKNy9dBaMbkdfrcKMoO',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 2
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@valuestream.id',
                'password' => '$2y$10$OHo6s45Tl9B6TXQVGMp5RunGPLnImVQGXTuKNy9dBaMbkdfrcKMoO',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 3
                'name' => 'Treasury Dana',
                'username' => 'treasury-dana',
                'email' => 'treasury-dana@valuestream.id',
                'password' => '$2y$10$OHo6s45Tl9B6TXQVGMp5RunGPLnImVQGXTuKNy9dBaMbkdfrcKMoO',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 4
                'name' => 'Lahta Data',
                'username' => 'lahta-data',
                'email' => 'lahta-data@valuestream.id',
                'password' => '$2y$10$OHo6s45Tl9B6TXQVGMp5RunGPLnImVQGXTuKNy9dBaMbkdfrcKMoO',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 5
                'name' => 'IT OPS',
                'username' => 'it-ops',
                'email' => 'it-ops@valuestream.id',
                'password' => '$2y$10$OHo6s45Tl9B6TXQVGMp5RunGPLnImVQGXTuKNy9dBaMbkdfrcKMoO',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 6
                'name' => 'Indra Maulana',
                'username' => 'indra-maulana',
                'email' => 'indra-maulana@valuestream.id',
                'password' => '$2y$10$OHo6s45Tl9B6TXQVGMp5RunGPLnImVQGXTuKNy9dBaMbkdfrcKMoO',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 7
                'name' => 'unfeature',
                'username' => 'unfeature',
                'email' => 'unfeature@valuestream.id',
                'password' => '$2y$10$OHo6s45Tl9B6TXQVGMp5RunGPLnImVQGXTuKNy9dBaMbkdfrcKMoO',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [ // 8
                'name' => 'Yandi',
                'username' => 'yandi',
                'email' => 'yandi@valuestream.id',
                'password' => '$2y$10$OHo6s45Tl9B6TXQVGMp5RunGPLnImVQGXTuKNy9dBaMbkdfrcKMoO',
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
        ]);
    }
}
