<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Testimonial;
class TestimonialSeeder extends Seeder {
    public function run() {
        $items = [
            ['author_name'=>'John Smith','author_country'=>'UK','platform'=>'Google','rating'=>5,'title'=>'Excellent!','comment'=>'Amazing experience.','is_approved'=>true,'is_featured'=>true,'sort_order'=>1],
            ['author_name'=>'Anna Müller','author_country'=>'Germany','platform'=>'TripAdvisor','rating'=>5,'title'=>'Perfect','comment'=>'Flawless organization.','is_approved'=>true,'is_featured'=>true,'sort_order'=>2],
        ];
        foreach($items as $item) Testimonial::updateOrCreate(['title'=>$item['title']], $item);
    }
}
