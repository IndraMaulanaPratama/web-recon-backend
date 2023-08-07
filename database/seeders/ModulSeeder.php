<?php

namespace Database\Seeders;

use App\Models\Modul;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Modul::insert([
            [
                // id  => 1
                'name' => 'Auth Management',
                'menu' => 4,
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [
                // id  => 2
                'name' => 'Product/Area',
                'menu' => 1,
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [
                // id  => 3
                'name' => 'CID',
                'menu' => 1,
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [
                // id  => 4
                'name' => 'Biller',
                'menu' => 1,
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [
                // id => 5
                'name' => 'Partner',
                'menu' => 1,
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [
                // id => 6
                'name' => 'Bank',
                'menu' => 1,
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [
                // id => 7
                'name' => 'Account',
                'menu' => 1,
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [
                // id => 8
                'name' => 'Group Biller',
                'menu' => 1,
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [
                // id => 9
                'name' => 'Group Transfer Funds',
                'menu' => 1,
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [
                // id => 10
                'name' => 'Exclude Partner',
                'menu' => 1,
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [
                // id => 11
                'name' => 'Calendar',
                'menu' => 1,
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [
                // id => 12
                'name' => 'Profile Fee',
                'menu' => 1,
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [
                // id => 13
                'name' => 'Correction',
                'menu' => 1,
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [
                // id => 14
                'name' => 'General Recon Data',
                'menu' => 2,
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],
            [
                // id => 15
                'name' => 'Suspect Recon Data',
                'menu' => 2,
                'created_at' => Carbon::now('Asia/Jakarta'),
            ],

            // END OF AUTH MANAGEMENT //

        ]);
    }
}
