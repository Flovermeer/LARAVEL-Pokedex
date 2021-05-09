<?php

namespace Database\Factories;

use App\Models\Pokemon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PokemonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pokemon::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $gender = $this->faker->randomElement(['M', 'F'])[0];

        return [
            'name' => $this->faker->unique()->name(),
            'gender' => $gender,
            'trainers_id' => $this->faker->randomDigitNotZero(),
            'types_id' => $this->faker->randomDigitNotZero()
        ];
    }
}
