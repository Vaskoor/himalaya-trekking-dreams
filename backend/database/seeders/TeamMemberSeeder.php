<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\TeamMember;
class TeamMemberSeeder extends Seeder {
    public function run() {
        $members = [
            ['name'=>'Dipak Gurung','role'=>'Lead Guide','bio'=>'Certified guide.','experience'=>'15 Years','photo_path'=>null,'icon_emoji'=>'🏔️','sort_order'=>1,'is_active'=>true],
            ['name'=>'Lhakpa Sherpa','role'=>'Climbing Sherpa','bio'=>'Everest summiter.','experience'=>'12 Years','photo_path'=>null,'icon_emoji'=>'🧗','sort_order'=>2,'is_active'=>true],
        ];
        foreach($members as $member) TeamMember::updateOrCreate(['name'=>$member['name']], $member);
    }
}
