<?php

namespace Database\Factories;

use App\Models\EstiloJoias;
use App\Models\Marca;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Joias>
 */
class JoiasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nome'=>$this->faker->word(),
            'valor'=>$this->faker->numberBetween(10, 500),
        ];
    }
}