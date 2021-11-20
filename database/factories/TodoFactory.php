<?php

namespace Database\Factories;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Todo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(rand(1,3)),
            'body' => $this->faker->realtext(20),
            'deadline' => $this->faker->date(),
            // 'created_at' => $this->faker->,
            // 'updated_at' => $this->faker->,
        ];
    }
}
