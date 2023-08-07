<?php

namespace Database\Seeders;

use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::insert([
            [
                'name' => 'Master Data',
                'created_at' => Carbon::now('Asia/Jakarta')
            ],
            [
                'name' => 'Recon Data',
                'created_at' => Carbon::now('Asia/Jakarta')
            ],
            [
                'name' => 'Recon Dana',
                'created_at' => Carbon::now('Asia/Jakarta')
            ],
            [
                'name' => 'Management Data',
                'created_at' => Carbon::now('Asia/Jakarta')
            ],
        ]);
    }
}
