<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trek;
use App\Models\Region;
use App\Models\Itinerary;

class TrekSeeder extends Seeder
{
    public function run()
    {
        $region = Region::where('slug', 'everest-region')->first();
        
        $trek = Trek::updateOrCreate(
            ['slug' => 'everest-base-camp-trek'],
            [
                'duration' => '14 Days',
                'max_altitude' => 5550,
                'difficulty' => 'Moderate',
                'best_season' => 'Mar-May, Sep-Nov',
                'price' => 1299,
                'discount_price' => 1299,
                'group_size' => '2-12',
                'start_point' => 'Lukla',
                'end_point' => 'Lukla',
                'is_featured' => true,
                'is_active' => true,
                'region_id' => $region->id,
            ]
        );
        
        $trek->setTranslation('name', 'en', 'Everest Base Camp Trek')
             ->setTranslation('short_description', 'en', 'Trek to the base of the world\'s highest mountain')
             ->setTranslation('description', 'en', 'Detailed description...')
             ->save();
        
        // Add itineraries
        for ($i = 1; $i <= 14; $i++) {
            Itinerary::updateOrCreate(
                [
                    'trek_id' => $trek->id,
                    'day_number' => $i,
                ],
                [
                    'title' => "Day $i: Sample title",
                    'description' => "Detailed description for day $i",
                ]
            );
        }
    }
}