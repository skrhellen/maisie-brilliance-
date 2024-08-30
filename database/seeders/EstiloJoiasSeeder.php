<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EstiloJoias;

class EstiloJoiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run()
    {
        EstiloJoias::insert([

            ['EstiloJoias' => "Anel"],
            ['EstiloJoias' => "Brinco"],
            ['EstiloJoias' => "Colar"],
            ['EstiloJoias' => "Pulseira"],
            ['EstiloJoias' => "Chocker"],

        ]);
    }
}
