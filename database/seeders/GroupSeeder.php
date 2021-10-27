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
            'created_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('groups')->insert([
            'name' => 'BE',
            'created_at' => date('Y-m-d H:i:s')

        ]);
        
        DB::table('groups')->insert([
            'name' => 'Devops',
            'created_at' => date('Y-m-d H:i:s')

        ]);

        DB::table('groups')->insert([
            'name' => 'FS',
            'created_at' => date('Y-m-d H:i:s')

        ]);
        
    }
}
