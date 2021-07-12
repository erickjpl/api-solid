<?php

namespace Database\Factories\Sincronizador;

use App\Models\Sincronizador\Proceden;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProcedenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Proceden::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'des_proc' => $this->faker->word,
        'campo1' => $this->faker->word,
        'campo2' => $this->faker->word,
        'campo3' => $this->faker->word,
        'campo4' => $this->faker->word,
        'co_us_in' => $this->faker->word,
        'fe_us_in' => $this->faker->date('Y-m-d H:i:s'),
        'co_us_mo' => $this->faker->word,
        'fe_us_mo' => $this->faker->date('Y-m-d H:i:s'),
        'co_us_el' => $this->faker->word,
        'fe_us_el' => $this->faker->date('Y-m-d H:i:s'),
        'revisado' => $this->faker->word,
        'trasnfe' => $this->faker->word,
        'co_sucu' => $this->faker->word,
        'rowguid' => $this->faker->word
        ];
    }
}
