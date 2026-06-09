<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HelicopterTour;

class HelicopterTourSeeder extends Seeder
{
    public function run()
    {
        $tours = [
            [
                'slug' => 'everest-base-camp',
                'name' => 'Everest Base Camp Helicopter Tour',
                'short_description' => 'The ultimate Khumbu aerial pilgrimage',
                'description' => 'Soar above the crown of the world. Landing at Kala Patthar (5,545m) for a face‑to‑face view of Everest.',
                'narrative' => 'Soar above the crown of the world. Departing Kathmandu at dawn...',
                'safety_profile' => 'High‑altitude flights utilize Airbus AS350 B3e helicopters with emergency oxygen.',
                'duration' => '4–5 Hours',
                'subtitle' => 'The Ultimate Khumbu Aerial Pilgrimage',
                'altitude' => '5,545m',
                'badge' => 'Most Popular',
                'price' => 1299,
                'group_size' => '5 Pax',
                'best_season' => 'Sep–Nov, Mar–May',
                'hero_image' => 'https://images.unsplash.com/photo-1544735716-392fe2489ffa?q=80&w=800&auto=format',
                'highlights' => [
                    'Guaranteed window seat',
                    '15‑minute ground landing at Kala Patthar',
                    'Panoramic flight over Khumbu Glacier',
                    'Champagne breakfast at Everest View Hotel',
                ],
                'stats' => [
                    ['value' => '5,545m', 'label' => 'Landing Alt.'],
                    ['value' => '4.5 Hrs', 'label' => 'Flight Time'],
                    ['value' => '5 Pax', 'label' => 'Max Payload'],
                    ['value' => 'Oxygen', 'label' => 'Onboard Kit'],
                ],
                'places' => [
                    ['name' => 'Kathmandu', 'altitude' => '1,400m', 'note' => 'Takeoff', 'lat' => 27.6970, 'lng' => 85.3590],
                    ['name' => 'Kala Patthar', 'altitude' => '5,545m', 'note' => 'Landing for Everest views', 'lat' => 27.9950, 'lng' => 86.8285],
                    ['name' => 'Syangboche', 'altitude' => '3,880m', 'note' => 'Breakfast at Everest View Hotel', 'lat' => 27.8183, 'lng' => 86.7150],
                ],
                'itinerary' => [
                    ['time' => '06:00 AM', 'title' => 'Kathmandu Departure', 'desc' => 'Board your private helicopter.'],
                    ['time' => '07:15 AM', 'title' => 'Kala Patthar Landing', 'desc' => 'Land at 5,545m for views.'],
                    ['time' => '08:00 AM', 'title' => 'Breakfast at Syangboche', 'desc' => 'Champagne breakfast.'],
                ],
            ],
            [
                'slug' => 'annapurna-base-camp',
                'name' => 'Annapurna Base Camp Helicopter Tour',
                'short_description' => 'Journey into the Sanctuary of the Gods',
                'description' => 'Fly into a fortress of snow and ice. Landing at 4,130m in the Annapurna Sanctuary.',
                'narrative' => 'Fly into a fortress of snow and ice. Departing from Pokhara...',
                'safety_profile' => 'Rapid weather clearings, stable alpine conditions.',
                'duration' => '4 Hours',
                'subtitle' => 'Journey into the Sanctuary of the Gods',
                'altitude' => '4,130m',
                'badge' => 'Scenic Circuit',
                'price' => 899,
                'group_size' => '5 Pax',
                'best_season' => 'Sep–Nov, Mar–May',
                'hero_image' => 'https://images.unsplash.com/photo-1522163182402-834f871fd851?q=80&w=800&auto=format',
                'highlights' => [
                    'Touchdown directly in Annapurna Base Camp',
                    'Close‑up views of Machapuchare',
                    'Scenic flight over Phewa Lake',
                    'Gourmet breakfast at alpine lodge',
                ],
                'stats' => [
                    ['value' => '4,130m', 'label' => 'Landing Alt.'],
                    ['value' => '4.0 Hrs', 'label' => 'Flight Time'],
                    ['value' => '5 Pax', 'label' => 'Max Capacity'],
                ],
                'places' => [
                    ['name' => 'Pokhara', 'altitude' => '822m', 'note' => 'Takeoff', 'lat' => 28.2000, 'lng' => 83.9800],
                    ['name' => 'Annapurna Base Camp', 'altitude' => '4,130m', 'note' => 'Sanctuary landing', 'lat' => 28.5300, 'lng' => 83.8780],
                ],
                'itinerary' => [
                    ['time' => '06:30 AM', 'title' => 'Pokhara Takeoff', 'desc' => 'Depart lakeside terminal.'],
                    ['time' => '07:20 AM', 'title' => 'ABC Touchdown', 'desc' => 'Land at base camp.'],
                ],
            ],
            // Add more: Langtang, Muktinath, Manaslu, Kanchenjunga
        ];

        foreach ($tours as $data) {
            $tour = HelicopterTour::firstOrNew(['slug' => $data['slug']]);
            $tour->fill([
                'duration' => $data['duration'],
                'subtitle' => $data['subtitle'],
                'altitude' => $data['altitude'],
                'badge' => $data['badge'],
                'price' => $data['price'],
                'group_size' => $data['group_size'],
                'best_season' => $data['best_season'],
                'hero_image' => $data['hero_image'],
                'is_active' => true,
            ]);
            $tour->setTranslation('name', 'en', $data['name'])
                 ->setTranslation('short_description', 'en', $data['short_description'])
                 ->setTranslation('description', 'en', $data['description'])
                 ->setTranslation('narrative', 'en', $data['narrative'])
                 ->setTranslation('safety_profile', 'en', $data['safety_profile'])
                 ->setTranslation('highlights', 'en', $data['highlights'])
                 ->setTranslation('stats', 'en', $data['stats'])
                 ->setTranslation('places', 'en', $data['places'])
                 ->setTranslation('itinerary', 'en', $data['itinerary']);
            $tour->save();
        }
    }
}