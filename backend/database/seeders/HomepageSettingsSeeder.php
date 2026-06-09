<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\HomepageSetting;
class HomepageSettingsSeeder extends Seeder {
    public function run() {
        $settings = [
            ['key'=>'hero_heading','value'=>json_encode(['en'=>'The Responsible Adventure Begins Here']),'type'=>'translatable'],
            ['key'=>'hero_subheading','value'=>json_encode(['en'=>'Discover authentic expeditions.']),'type'=>'translatable'],
            ['key'=>'hero_video','value'=>'/videos/vai.mp4','type'=>'text'],
            ['key'=>'hero_fallback_image','value'=>'https://images.pexels.com/photos/417173/pexels-photo-417173.jpeg','type'=>'text'],
        ];
        foreach($settings as $setting) HomepageSetting::updateOrCreate(['key'=>$setting['key']], $setting);
    }
}
