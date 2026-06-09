<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\CarouselSlide;
class CarouselSlideSeeder extends Seeder {
    public function run() {
        CarouselSlide::updateOrCreate(
            ['src'=>'https://images.unsplash.com/photo-1544735716-392fe2489ffa?q=80&w=800'],
            ['type'=>'image','alt'=>'Himalayas','sort_order'=>1,'is_active'=>true]
        );
    }
}
