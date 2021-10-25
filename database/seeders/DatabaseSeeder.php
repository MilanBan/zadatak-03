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
        $this->call(RoleSeeder::class);
        \App\Models\User::factory(20)->create();
        $this->call(MentorSeeder::class);
    }
}
