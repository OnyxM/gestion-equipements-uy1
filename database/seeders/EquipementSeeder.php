<?php

namespace Database\Seeders;

use App\Models\Equipement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipements = [
            [
                'code' => 'VPHP1834',
                'name' => 'Vidéo Projecteur HP Black',
            ],
        ];

        foreach ($equipements as $equipement) {
            Equipement::create([
                'code' => $equipement['code'],
                'name' => $equipement['name'],
                'description' => "Description de l'équipement " . $equipement['code'] ,
                'created_by' => 1,
            ]);
        }
    }
}
