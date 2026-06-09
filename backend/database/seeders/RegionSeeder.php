<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    public function run()
    {
        $regions = [
            ['name' => 'Everest Region', 'slug' => 'everest-region', 'description' => 'Home to Mt. Everest'],
            ['name' => 'Annapurna Region', 'slug' => 'annapurna-region', 'description' => 'Annapurna Circuit and Base Camp'],
            ['name' => 'Langtang Region', 'slug' => 'langtang-region', 'description' => 'Langtang Valley'],
        ];
        
        foreach ($regions as $region) {
            Region::updateOrCreate(
                ['slug' => $region['slug']],
                $region
            );
        }
    }
}