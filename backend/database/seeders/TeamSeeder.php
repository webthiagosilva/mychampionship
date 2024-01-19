<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teamNames = [
            'Chuteiras Cosmicasc FC',
            'Bola na Rede FC',
            'Zueira United',
            'Perna de Pau Futebol Clube',
            'Frenéticos dos Gramados',
            'Feras da Vizinhança',
            'Tigres da Vila',
            'Futebol e Cerveja',
            'Os Peladeiros',
            'Bagaceiros FC',
        ];

        $teams = [];
        foreach ($teamNames as $name) {
            $teams[] = [
                'nome' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::connection('mysql')
            ->table('times')
            ->insert($teams);
    }
}
