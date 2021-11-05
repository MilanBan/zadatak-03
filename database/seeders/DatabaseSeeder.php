<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\MentorSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);             // 4
        $this->call(UserSeeder::class);    // 20
        $this->call(GroupSeeder::class);            // 4 
        $this->call(MentorSeeder::class);           // 10
        $this->call(InternSeeder::class);           // 40
        $this->call(GroupMentorSeeder::class);           // 10
        $this->call(AssignmentSeeder::class);           // 10
        $this->call(AssignmentGroupSeeder::class);           // 10
    }
}
