<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Intern;
use App\Models\Mentor;
use App\Models\Assignment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $f = Factory::create();

        for ($i=1;$i<=40;$i++) {

            DB::table('reviews')->insert([
                'assignment_id'=> Assignment::select('id')->orderByRaw("RAND()")->first()->id,
                'mentor_id' => Mentor::select('id')->orderByRaw("RAND()")->first()->id,
                'intern_id' => Intern::select('id')->orderByRaw("RAND()")->first()->id,
                'mark' => rand(1, 10),
                'pros' => $f->sentence(),
                'cons' => $f->sentence(),  
                'created_at' => date('Y-m-d H:i:s')
            ]);
        
        }

    }
}
