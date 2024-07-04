<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Equipement;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory()->create([
             'name' => 'Admin',
             'email' => 'admin@example.com',
             'role' => "admin"
         ]);

         \App\Models\User::factory(25)->create();


         Equipement::factory(5)->create();
    }
}
