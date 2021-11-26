<?php

namespace Database\Seeders;

use Database\Seeders\MentorSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(MentorSeeder::class);
        $this->call(InternSeeder::class);
        $this->call(GroupMentorSeeder::class);
        $this->call(AssignmentSeeder::class);
        $this->call(AssignmentGroupSeeder::class);
        $this->call(ReviewSeeder::class);
    }
}
