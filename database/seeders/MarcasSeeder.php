<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Marca::insert([
            ['nome' => "Tiffany & Co."],
            ['nome' => "Cartier"],
            ['nome' => "Bulgari"],
            ['nome' => "Harry Winston"],
            ['nome' => "Van Cleef & Arpels"],
            ['nome' => "Chopard"],
            ['nome' => "David Yurman"],
            ['nome' => "Swarovski"],
            ['nome' => "Pandora"],
            ['nome' => "Mikimoto"],
            ['nome' => "Piaget"],
            ['nome' => "Graff"],
            ['nome' => "Boucheron"],
            ['nome' => "Buccellati"],
            ['nome' => "Roberto Coin"],
            ['nome' => "Montblanc"],
            ['nome' => "Alex and Ani"],
            ['nome' => "Kendra Scott"],
            ['nome' => "Stephen Webster"],
            ['nome' => "Thomas Sabo"],
            ['nome' => "Lagos"],
            ['nome' => "John Hardy"],
            ['nome' => "Monica Vinader"],
            ['nome' => "Elsa Peretti"],
            ['nome' => "Links of London"],
        ]);
    }
}