<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\SeasonalGuide;
class SeasonalGuideSeeder extends Seeder
{
    public function run()
    {
        $guides = [
            [
                'slug' => 'spring-trekking-in-nepal',
                'title' => json_encode(['en' => 'Spring Trekking in Nepal (March–May)']),
                'excerpt' => json_encode(['en' => 'Experience blooming rhododendrons, stable weather, and clear mountain views.']),
                'content' => json_encode(['en' => '<h2>Why Trek in Spring?</h2><p>Spring is one of the best times to trek.</p>']),
                'season' => 'spring',
                'month_range' => 'March–May',
                'weather_summary' => json_encode(['en' => 'Warm days, cool nights.']),
                'pros' => json_encode(['en' => ['Stable weather', 'Clear views']]),
                'cons' => json_encode(['en' => ['Crowded']]),
                'recommended_treks' => json_encode(['everest-base-camp-trek']),
                'author' => 'Admin',
                'published_at' => now(),
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'slug' => 'autumn-trekking-nepal',
                'title' => json_encode(['en' => 'Autumn Trekking in Nepal (September–November)']),
                'excerpt' => json_encode(['en' => 'Peak season with crystal‑clear skies.']),
                'content' => json_encode(['en' => '<h2>Why Autumn is the Best</h2><p>Perfect weather.</p>']),
                'season' => 'autumn',
                'month_range' => 'September–November',
                'weather_summary' => json_encode(['en' => 'Sunny, mild.']),
                'pros' => json_encode(['en' => ['Best visibility', 'Festivals']]),
                'cons' => json_encode(['en' => ['Crowded']]),
                'recommended_treks' => json_encode(['annapurna-circuit-trek']),
                'author' => 'Admin',
                'published_at' => now(),
                'is_active' => true,
                'sort_order' => 2,
            ],
        ];
        foreach ($guides as $data) {
            $guide = SeasonalGuide::updateOrCreate(['slug' => $data['slug']], $data);
            // Ensure published_at is in the past (if current time might be in the future due to timezone)
            $guide->published_at = now()->subDay();
            $guide->save();
        }
    }
}
