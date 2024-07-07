<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Equipement;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'role' => "admin"
            ]
//            ,[
//                'name' => 'Délégué M1 SIGL',
//                'email' => 'delegue1@example.com',
//                'role' => "delegue"
//            ]
        ];

        foreach ($users as $user) {
            User::factory($user)->create();
        }

         $this->call(EquipementSeeder::class);
    }
}
