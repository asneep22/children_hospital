<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\pacients>
 */
class PacientsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'lastname' => $this->faker->lastname(),
            'pname' => $this->faker->firstname(),
            'surname' => $this->faker->text(8),
            'birthday' => $this->faker->date(),
            'uchastok_id' => $this->faker->numberBetween(1,25),
            'roddom_id' => $this->faker->numberBetween(1,25),
            'rost' => $this->faker->numberBetween(100,200),
            'ves' => $this->faker->numberBetween(1000,3000),
            'gestaci' => $this->faker->numberBetween(20,50),
            'date_add' => $this->faker->date(),
        ];
    }
}
