<?php

namespace Database\Factories\Sincronizador;

use App\Models\Sincronizador\Vendedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendedorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vendedor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tipo' => $this->faker->word,
        'ven_des' => $this->faker->word,
        'dis_cen' => $this->faker->text,
        'cedula' => $this->faker->word,
        'direc1' => $this->faker->word,
        'direc2' => $this->faker->word,
        'telefonos' => $this->faker->word,
        'fecha_reg' => $this->faker->date('Y-m-d H:i:s'),
        'condic' => $this->faker->word,
        'comision' => $this->faker->word,
        'comen' => $this->faker->text,
        'fun_cob' => $this->faker->word,
        'fun_ven' => $this->faker->word,
        'comisionv' => $this->faker->word,
        'fac_ult_ve' => $this->faker->randomDigitNotNull,
        'fec_ult_ve' => $this->faker->date('Y-m-d H:i:s'),
        'net_ult_ve' => $this->faker->word,
        'cli_ult_ve' => $this->faker->word,
        'cta_contab' => $this->faker->word,
        'campo1' => $this->faker->word,
        'campo2' => $this->faker->word,
        'campo3' => $this->faker->word,
        'campo4' => $this->faker->word,
        'campo5' => $this->faker->word,
        'campo6' => $this->faker->word,
        'campo7' => $this->faker->word,
        'campo8' => $this->faker->word,
        'co_us_in' => $this->faker->word,
        'fe_us_in' => $this->faker->date('Y-m-d H:i:s'),
        'co_us_mo' => $this->faker->word,
        'fe_us_mo' => $this->faker->date('Y-m-d H:i:s'),
        'co_us_el' => $this->faker->word,
        'fe_us_el' => $this->faker->date('Y-m-d H:i:s'),
        'revisado' => $this->faker->word,
        'trasnfe' => $this->faker->word,
        'co_sucu' => $this->faker->word,
        'rowguid' => $this->faker->word,
        'login' => $this->faker->word,
        'password' => $this->faker->word,
        'email' => $this->faker->word,
        'PSW_M' => $this->faker->word
        ];
    }
}
