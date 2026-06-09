<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\WhyChooseUs;
class WhyChooseUsSeeder extends Seeder {
    public function run() {
        $items = [
            ['title'=>'Local Experts','seo_title'=>'Native Himalayan Guides','description'=>'Born and raised in the mountains.','icon'=>'Users','stats'=>json_encode([['val'=>'50+','label'=>'Expert Guides']]),'bullets'=>json_encode(['Fluent English','Certified']),'sort_order'=>1,'is_active'=>true],
            ['title'=>'Safety First','seo_title'=>'Rigorous Standards','description'=>'Modern equipment and trained guides.','icon'=>'Shield','stats'=>json_encode([['val'=>'100%','label'=>'Safety Record']]),'bullets'=>json_encode(['First aid trained','Oxygen kits']),'sort_order'=>2,'is_active'=>true],
        ];
        foreach($items as $item) WhyChooseUs::updateOrCreate(['title'=>$item['title']], $item);
    }
}
