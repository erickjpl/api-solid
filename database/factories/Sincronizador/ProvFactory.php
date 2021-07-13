<?php

namespace Database\Factories\Sincronizador;

use App\Models\Sincronizador\Prov;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProvFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Prov::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'prov_des' => $this->faker->word,
        'co_seg' => $this->faker->word,
        'co_zon' => $this->faker->word,
        'inactivo' => $this->faker->word,
        'productos' => $this->faker->word,
        'direc1' => $this->faker->text,
        'direc2' => $this->faker->word,
        'telefonos' => $this->faker->word,
        'fax' => $this->faker->word,
        'respons' => $this->faker->word,
        'fecha_reg' => $this->faker->date('Y-m-d H:i:s'),
        'tipo' => $this->faker->word,
        'com_ult_co' => $this->faker->randomDigitNotNull,
        'fec_ult_co' => $this->faker->date('Y-m-d H:i:s'),
        'net_ult_co' => $this->faker->word,
        'saldo' => $this->faker->word,
        'saldo_ini' => $this->faker->word,
        'mont_cre' => $this->faker->word,
        'plaz_pag' => $this->faker->randomDigitNotNull,
        'desc_ppago' => $this->faker->word,
        'desc_glob' => $this->faker->word,
        'tipo_iva' => $this->faker->word,
        'iva' => $this->faker->word,
        'rif' => $this->faker->word,
        'nacional' => $this->faker->word,
        'dis_cen' => $this->faker->text,
        'nit' => $this->faker->word,
        'email' => $this->faker->word,
        'co_ingr' => $this->faker->word,
        'comentario' => $this->faker->text,
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
        'juridico' => $this->faker->word,
        'tipo_adi' => $this->faker->word,
        'matriz' => $this->faker->word,
        'co_tab' => $this->faker->randomDigitNotNull,
        'tipo_per' => $this->faker->word,
        'co_pais' => $this->faker->word,
        'ciudad' => $this->faker->word,
        'zip' => $this->faker->word,
        'website' => $this->faker->word,
        'formtype' => $this->faker->word,
        'taxid' => $this->faker->word,
        'porc_esp' => $this->faker->randomDigitNotNull,
        'contribu_e' => $this->faker->word
        ];
    }
}
