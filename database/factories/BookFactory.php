<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name(),
            'created_at' => $this->faker->dateTimeBetween('-2 years'),
            'updated_at' => function(array $attributes){
                return $this->faker->dateTimeBetween($attributes['created_at'] , 'now');
            },
        ];
    }
}
