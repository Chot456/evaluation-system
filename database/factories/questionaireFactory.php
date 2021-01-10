<?php

namespace Database\Factories;

use App\Models\questionaire;
use App\Models\userType;
use Illuminate\Database\Eloquent\Factories\Factory;

class questionaireFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = questionaire::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userTypeId = userType::all()->pluck('id')->toArray();
        
        return [
            'questionDescription' => $this->faker->text(50),
            'userTypeId' => $this->faker->randomElement($userTypeId)
        ];
    }
}
