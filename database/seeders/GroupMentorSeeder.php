<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Mentor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupMentorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0;$i<10;$i++) { 
               
            DB::table('group_mentor')->insert(
                [
                    'group_id' => Group::select('id')->orderByRaw("RAND()")->first()->id,
                    'mentor_id' => Mentor::select('id')->orderByRaw("RAND()")->first()->id,
                ]
            );
        }
    }
}
