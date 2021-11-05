<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Assignment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssignmentGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0;$i<10;$i++) { 
               
            DB::table('assignment_group')->insert(
                [
                    'group_id' => Group::select('id')->orderByRaw("RAND()")->first()->id,
                    'assignment_id' => Assignment::select('id')->orderByRaw("RAND()")->first()->id,
                ]
            );
        }
    }
}
