<?php

namespace Database\Factories;

use App\Models\course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class courseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'title'=>$this->faker->sentence(),
            'description'=>$this->faker->paragraphs(3,true),
            'user_id'=>User::all()->random()->id
        ];
    }
}
