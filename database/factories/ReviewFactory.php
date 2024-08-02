<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'book_id' => null,
            'review' => $this->faker->paragraph(),
            'rating' => $this->faker->numberBetween(1, 5),
            'created_at' => $this->faker->dateTimeBetween('-2 years'),
            'updated_at' => function(array $attributes){
                return $this->faker->dateTimeBetween($attributes['created_at'] , 'now');
            }
        ];
    }

    public function good()
    {
        return $this->state(function(array $attributes){
            return [
                'rating' => $this->faker->numberBetween(4 , 5)
            ];
        });
    }

     public function average()
     {
     return $this->state(function(array $attributes){
            return [
                'rating' => $this->faker->numberBetween(2 , 5)
            ];
     });
     }
      public function bad()
      {
      return $this->state(function(array $attributes){
            return [
                'rating' => $this->faker->numberBetween(1 , 3)
            ];
      });
      }
}
