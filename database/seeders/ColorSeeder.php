<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductColor;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['name'=>'White','description'=>'White','hex'=>'#FFFFFF'],
            ['name'=>'Black','description'=>'Black','hex'=>'#000000'],
            ['name'=>'Red','description'=>'Red','hex'=>'#FF0000'],
            ['name'=>'Green','description'=>'Green','hex'=>'#008000'],
            ['name'=>'Blue','description'=>'Blue','hex'=>'#0000FF']
        ];
        ProductColor::insert($colors);
    }
}
