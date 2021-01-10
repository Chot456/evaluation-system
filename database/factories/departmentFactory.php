<?php

namespace Database\Factories;

use App\Models\department;
use Illuminate\Database\Eloquent\Factories\Factory;

class departmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = department::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'deptDescription' => $this->faker->text(50),
            'deptAcronym' => $this->faker->text(20)
        ];
    }
}
