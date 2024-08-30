<?php

namespace Database\Seeders;

use App\Models\Joias;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JoiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Joias::factory()->count(3)->create();
    }
}
