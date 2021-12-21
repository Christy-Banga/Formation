<?php

namespace Database\Seeders;

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
         \App\Models\User::factory(1)->create();
         \App\Models\Formation::factory(15)->create();
         \App\Models\Episode::factory(150)->create();
         $this->call([
            RoleSeeder::class,
            UserSeeder::class
         ]);
         \App\Models\Role::factory()->hasUsers(100)->create();
    }
}
