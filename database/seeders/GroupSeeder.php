<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        DB::table('groups')->insert([
            'name' => 'FE',
        ]);

        DB::table('groups')->insert([
            'name' => 'BE',
        ]);
        
        DB::table('groups')->insert([
            'name' => 'Devops',
        ]);

        DB::table('groups')->insert([
            'name' => 'FS',
        ]);
        
    }
}
