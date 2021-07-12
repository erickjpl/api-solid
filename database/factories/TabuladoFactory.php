<?php

namespace Database\Factories\Sincronizador;

use App\Models\Sincronizador\Tabulado;
use Illuminate\Database\Eloquent\Factories\Factory;

class TabuladoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tabulado::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'descripcio' => $this->faker->word,
        'porc_vent' => $this->faker->word,
        'porc_comp' => $this->faker->word,
        'porc_cxs' => $this->faker->word,
        'porc_otro' => $this->faker->word,
        'revisado' => $this->faker->word,
        'trasnfe' => $this->faker->word,
        'rowguid' => $this->faker->word
        ];
    }
}
