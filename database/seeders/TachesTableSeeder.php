<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TachesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'titre' => 'Faire la lessive',
                'description' => 'Laver les vêtements et les draps.',
                'date_échéance' => now()->addDays(1),
                'status' => 'terminée',
            ],
            [
                'titre' => 'Prendre rendez-vous chez le médecin',
                'description' => 'Prendre rendez-vous pour le bilan de santé annuel.',
                'date_échéance' => now()->addDays(7),
                'status' => 'en cours',
            ],
            [
                'titre' => 'Organiser une réunion d\'équipe',
                'description' => 'Fixer une date et un lieu pour la réunion.',
                'date_échéance' => now()->addDays(3),
                'status' => 'en cours',
            ],
            
        ];

        // Insert data into the database
        DB::table('taches')->insert($data);
    }
}
