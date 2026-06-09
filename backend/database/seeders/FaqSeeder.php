<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    public function run()
    {
        $faqs = [
            [
                'category' => 'General',
                'question' => json_encode(['en' => 'What is the best season for trekking?']),
                'answer' => json_encode(['en' => 'Spring (March-May) and Autumn (September-November) offer the best weather and clear views.']),
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'category' => 'Permits',
                'question' => json_encode(['en' => 'What permits do I need?']),
                'answer' => json_encode(['en' => 'Most treks require TIMS card and national park permits. We arrange them for you.']),
                'sort_order' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            // Avoid JSON column in where clause for PostgreSQL compatibility
            $existing = Faq::where('category', $faq['category'])->first();
            if ($existing) {
                $existing->update($faq);
            } else {
                Faq::create($faq);
            }
        }
    }
}
