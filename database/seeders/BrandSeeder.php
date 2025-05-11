<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::trauncate('brands');
        DB::table('brands')->insert([
            [
                'name' => 'Brand 1',
                'logo' => 'brand1.png',
                'slug' => 'brand-1',
            ],
            [
                'name' => 'Brand 2',
                'logo' => 'logos/brand2.png',
                'slug' => 'brand-2',
            ],
            [
                'name' => 'Brand 3',
                'logo' => 'logos/brand3.png',
                'slug' => 'brand-3',
            ],
            [
                'name' => 'Brand 4',
                'logo' => 'logos/brand4.png',
                'slug' => 'brand-4',
            ],
            [
                'name' => 'Brand 5',
                'logo' => 'logos/brand5.png',
                'slug' => 'brand-5',
            ],
        ]);
    }
}
