<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TravelGuide;
use Illuminate\Support\Str;

class TravelGuideSeeder extends Seeder
{
    public function run()
    {
        $guides = [
            [
                'slug' => 'nepal-travel-information',
                'title' => ['en' => 'Nepal Travel Information: Visa, Flights & Essential Tips'],
                'excerpt' => ['en' => 'Complete guide for planning your trip to Nepal – visa requirements, international flights, local transportation, and more.'],
                'content' => ['en' => '<h2>Visa Requirements</h2><p>Most nationalities can obtain a visa on arrival at Tribhuvan International Airport or at land border crossings.</p>'],
                'category' => 'Planning',
                'author' => 'Admin',
                'published_at' => now(),
                'is_active' => true,
                'sort_order' => 1,
                'tags' => ['visa', 'flights'],
                'meta_title' => 'Nepal Travel Information',
                'meta_description' => 'Complete guide to planning your Nepal trip.',
            ],
        ];

        foreach ($guides as $data) {
            $guide = TravelGuide::updateOrCreate(['slug' => $data['slug']], $data);
            foreach ($data['title'] as $locale => $title) {
                $guide->setTranslation('title', $locale, $title);
                $guide->setTranslation('excerpt', $locale, $data['excerpt'][$locale] ?? $data['excerpt']['en']);
                $guide->setTranslation('content', $locale, $data['content'][$locale] ?? $data['content']['en']);
            }
            $guide->save();
        }
    }
}
