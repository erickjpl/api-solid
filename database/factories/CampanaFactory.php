<?php

namespace Database\Factories\Marketing;

use App\Models\Marketing\Campana;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampanaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Campana::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'campana' => $this->faker->word,
        'from_name' => $this->faker->word,
        'from_email' => $this->faker->word,
        'asunto' => $this->faker->word,
        'fecha' => $this->faker->date('Y-m-d H:i:s'),
        'status' => $this->faker->word,
        'lista' => $this->faker->word,
        'total_audiencia' => $this->faker->randomDigitNotNull,
        'step' => $this->faker->randomDigitNotNull,
        'email' => $this->faker->text,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
