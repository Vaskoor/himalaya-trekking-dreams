<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;

class AdditionalActivitiesSeeder extends Seeder
{
    public function run()
    {
        $activities = [
            [
                'slug' => 'patan-bhaktapur-tour',
                'name' => ['en' => 'Patan & Bhaktapur Tour'],
                'short_description' => ['en' => 'Explore medieval squares and ancient Newari architecture'],
                'description' => ['en' => 'Full‑day tour of two UNESCO World Heritage Durbar Squares with expert guide.'],
                'duration' => '1 Day',
                'price' => 75,
                'difficulty' => 'Easy',
                'group_size' => '1–12',
                'best_season' => 'All year',
                'is_active' => true,
                'hero_image' => 'https://images.unsplash.com/photo-1544735716-392fe2489ffa',
                'icon' => '🏯',
                'tag' => 'Cultural',
                'sort_order' => 5,
                'is_featured' => true,
            ],
            [
                'slug' => 'bungee-jumping',
                'name' => ['en' => 'Bungee Jumping'],
                'short_description' => ['en' => 'Ultimate adrenaline rush over a 160m gorge'],
                'description' => ['en' => 'Jump from Nepal’s highest bungee platform over the Bhote Koshi River.'],
                'duration' => '1 Day',
                'price' => 85,
                'difficulty' => 'Moderate',
                'group_size' => '2–10',
                'best_season' => 'Sep–Jun',
                'is_active' => true,
                'hero_image' => 'https://images.unsplash.com/photo-1533245270348-821d102174c8',
                'icon' => '🪂',
                'tag' => 'Adventure',
                'sort_order' => 6,
                'is_featured' => true,
            ],
            [
                'slug' => 'paragliding-pokhara',
                'name' => ['en' => 'Paragliding in Pokhara'],
                'short_description' => ['en' => 'Soar above Phewa Lake with Himalayan views'],
                'description' => ['en' => 'Tandem paragliding flight over Pokhara valley and Fewa Lake.'],
                'duration' => '1 Day',
                'price' => 120,
                'difficulty' => 'Easy',
                'group_size' => '1–8',
                'best_season' => 'Sep–Nov, Feb–Apr',
                'is_active' => true,
                'hero_image' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4',
                'icon' => '🪁',
                'tag' => 'Adventure',
                'sort_order' => 7,
                'is_featured' => true,
            ],
        ];

        foreach ($activities as $data) {
            Activity::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }
}