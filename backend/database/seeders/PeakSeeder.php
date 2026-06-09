<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Peak;

class PeakSeeder extends Seeder
{
    public function run()
    {
        $peaks = [
            [
                'slug' => 'island-peak',
                'name' => 'Island Peak',
                'short_description' => 'Scale the iconic Imja Tse surrounded by a sea of ice.',
                'description' => 'Island Peak (6,189m) is the most popular trekking peak in Nepal. Perfect for novice climbers looking to gain high‑altitude mountaineering experience.',
                'tagline' => 'Imja Tse',
                'duration' => '20 Days',
                'max_altitude' => 6189,
                'difficulty' => 'Moderate',
                'best_season' => 'Apr – May · Oct – Nov',
                'price' => 2499,
                'group_size' => '2–10',
                'start_point' => 'Kathmandu',
                'end_point' => 'Kathmandu',
                'start_end' => 'Kathmandu / Kathmandu',
                'is_featured' => true,
                'hero_image' => 'https://images.unsplash.com/photo-1588714477688-ceacfbdf63b4?q=80&w=800&auto=format',
                'icon' => '🏔️',
                'tag' => 'Most Popular',
                'highlights' => [
                    'Summit Island Peak (6,189m)',
                    'Trek to Everest Base Camp',
                    'Learn mountaineering skills',
                    'Views of Lhotse, Makalu, Ama Dablam',
                ],
                'places' => [],
                'included' => ['Climbing permit', 'Guide', 'Accommodation'],
                'excluded' => ['Personal gear', 'Insurance'],
                'itinerary' => [['day' => 1, 'title' => 'Arrival', 'description' => 'Arrive Kathmandu']],
            ],
            [
                'slug' => 'mera-peak',
                'name' => 'Mera Peak',
                'short_description' => 'Nepal\'s highest trekking peak in the remote Hinku Valley.',
                'description' => 'At 6,476m (21,246 ft), Mera Peak is the highest permitted trekking peak in Nepal. Non-technical climb suitable for fit beginners.',
                'tagline' => 'Hinku Valley',
                'duration' => '18 Days',
                'max_altitude' => 6476,
                'difficulty' => 'Moderate',
                'best_season' => 'Apr – May · Oct – Nov',
                'price' => 2499,
                'group_size' => '2–10',
                'start_point' => 'Kathmandu',
                'end_point' => 'Kathmandu',
                'start_end' => 'Kathmandu / Kathmandu',
                'is_featured' => true,
                'hero_image' => 'https://images.unsplash.com/photo-1522163182402-834f871fd851?q=80&w=800&auto=format',
                'icon' => '🏔️',
                'tag' => 'Highest Trekking Peak',
                'highlights' => [
                    'Highest trekking peak in Nepal',
                    'Non-technical climb',
                    'Remote Hinku Valley',
                    'Views of five 8,000m peaks',
                ],
                'places' => [],
                'included' => ['Permits', 'Guide', 'Accommodation'],
                'excluded' => ['Personal gear', 'Insurance'],
                'itinerary' => [['day' => 1, 'title' => 'Arrival', 'description' => 'Arrive Kathmandu']],
            ],
            [
                'slug' => 'lobuche-east',
                'name' => 'Lobuche East',
                'short_description' => 'Technical ascent in the heart of the Khumbu.',
                'description' => 'Lobuche East (6,119m) is a technically demanding trekking peak requiring ice climbing skills. Excellent preparation for 8,000m peaks.',
                'tagline' => 'Khumbu Region',
                'duration' => '19 Days',
                'max_altitude' => 6119,
                'difficulty' => 'Technical',
                'best_season' => 'Apr – May · Oct – Nov',
                'price' => 2299,
                'group_size' => '2–8',
                'start_point' => 'Kathmandu',
                'end_point' => 'Kathmandu',
                'start_end' => 'Kathmandu / Kathmandu',
                'is_featured' => true,
                'hero_image' => 'https://images.unsplash.com/photo-1544735716-1fcd0efc1cba?q=80&w=800&auto=format',
                'icon' => '🏔️',
                'tag' => 'Technical Ascent',
                'highlights' => [
                    'Technical ice and snow climbing',
                    'Acclimatize via Everest Base Camp',
                    'Unobstructed Everest views',
                ],
                'places' => [],
                'included' => ['Permits', 'Guide 1:2 ratio', 'Accommodation'],
                'excluded' => ['Personal gear', 'Insurance'],
                'itinerary' => [['day' => 1, 'title' => 'Arrival', 'description' => 'Arrive Kathmandu']],
            ],
            [
                'slug' => 'pokalde-peak',
                'name' => 'Pokalde Peak',
                'short_description' => 'A thrilling rock scramble near Kongma La Pass.',
                'description' => 'Pokalde Peak (5,806m) involves a rocky scramble along a dramatic ridge. Perfect add-on for trekkers who want to bag a Himalayan peak without heavy technical ice climbing.',
                'tagline' => 'Kongma La',
                'duration' => '18 Days',
                'max_altitude' => 5806,
                'difficulty' => 'Easy–Moderate',
                'best_season' => 'Apr – May · Oct – Nov',
                'price' => 1999,
                'group_size' => '2–12',
                'start_point' => 'Kathmandu',
                'end_point' => 'Kathmandu',
                'start_end' => 'Kathmandu / Kathmandu',
                'is_featured' => true,
                'hero_image' => 'https://images.unsplash.com/photo-1587595431973-160d0d94add1?q=80&w=800&auto=format',
                'icon' => '🏔️',
                'tag' => 'Best Value',
                'highlights' => [
                    'Short and accessible climb',
                    'Cross Kongma La Pass',
                    'Spectacular views of Makalu and Ama Dablam',
                ],
                'places' => [],
                'included' => ['Permits', 'Guide', 'Accommodation'],
                'excluded' => ['Personal gear', 'Insurance'],
                'itinerary' => [['day' => 1, 'title' => 'Arrival', 'description' => 'Arrive Kathmandu']],
            ],
        ];

        foreach ($peaks as $data) {
            $peak = Peak::firstOrNew(['slug' => $data['slug']]);
            $peak->fill([
                'duration' => $data['duration'],
                'max_altitude' => $data['max_altitude'],
                'difficulty' => $data['difficulty'],
                'best_season' => $data['best_season'],
                'price' => $data['price'],
                'group_size' => $data['group_size'],
                'start_point' => $data['start_point'],
                'end_point' => $data['end_point'],
                'start_end' => $data['start_end'],
                'is_featured' => $data['is_featured'],
                'is_active' => true,
                'hero_image' => $data['hero_image'],
                'icon' => $data['icon'],
                'tag' => $data['tag'],
            ]);
            $peak->setTranslation('name', 'en', $data['name'])
                 ->setTranslation('short_description', 'en', $data['short_description'])
                 ->setTranslation('description', 'en', $data['description'])
                 ->setTranslation('tagline', 'en', $data['tagline'])
                 ->setTranslation('highlights', 'en', $data['highlights'])
                 ->setTranslation('places', 'en', $data['places'])
                 ->setTranslation('included', 'en', $data['included'])
                 ->setTranslation('excluded', 'en', $data['excluded'])
                 ->setTranslation('itinerary', 'en', $data['itinerary']);
            $peak->save();
        }
    }
}