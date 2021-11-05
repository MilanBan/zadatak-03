<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Assignment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $f = Factory::create();

        for ($i=1;$i<=10;$i++) { 
               
            DB::table('assignments')->insert(
                [
                    'name' => 'Assignment-'.$i,
                    'description' => $f->text(),
                    'created_at' => date('Y-m-d H:i:s'),
                ]
            );
        }
    }
}
