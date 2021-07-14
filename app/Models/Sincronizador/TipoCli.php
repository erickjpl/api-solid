<?php

namespace App\Models\Sincronizador;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TipoCli
 * @package App\Models\Sincronizador
 *
 * @property \Illuminate\Database\Eloquent\Collection $clientes
 * @property string $des_tipo
 * @property string $precio_a
 * @property string $campo1
 * @property string $campo2
 * @property string $campo3
 * @property string $campo4
 * @property string $co_us_in
 * @property string|\Carbon\Carbon $fe_us_in
 * @property string $co_us_mo
 * @property string|\Carbon\Carbon $fe_us_mo
 * @property string $co_us_el
 * @property string|\Carbon\Carbon $fe_us_el
 * @property string $revisado
 * @property string $trasnfe
 * @property string $co_sucu
 * @property string $rowguid
 * @property string|\Carbon\Carbon $row_id
 */
class TipoCli extends Model
{
    use HasFactory;

    public $table = 'tipo_cli';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $connection = "sqlsrv";

    public $fillable = [
        'des_tipo',
        'precio_a',
        'campo1',
        'campo2',
        'campo3',
        'campo4',
        'co_us_in',
        'fe_us_in',
        'co_us_mo',
        'fe_us_mo',
        'co_us_el',
        'fe_us_el',
        'revisado',
        'trasnfe',
        'co_sucu',
        'rowguid',
        'row_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'tip_cli' => 'string',
        'des_tipo' => 'string',
        'precio_a' => 'string',
        'campo1' => 'string',
        'campo2' => 'string',
        'campo3' => 'string',
        'campo4' => 'string',
        'co_us_in' => 'string',
        'fe_us_in' => 'datetime',
        'co_us_mo' => 'string',
        'fe_us_mo' => 'datetime',
        'co_us_el' => 'string',
        'fe_us_el' => 'datetime',
        'revisado' => 'string',
        'trasnfe' => 'string',
        'co_sucu' => 'string',
        'rowguid' => 'string',
        'row_id' => 'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'des_tipo' => 'required|string|max:60',
        'precio_a' => 'required|string|max:20',
        'campo1' => 'required|string|max:60',
        'campo2' => 'required|string|max:60',
        'campo3' => 'required|string|max:60',
        'campo4' => 'required|string|max:60',
        'co_us_in' => 'required|string|max:6',
        'fe_us_in' => 'required',
        'co_us_mo' => 'required|string|max:6',
        'fe_us_mo' => 'required',
        'co_us_el' => 'required|string|max:6',
        'fe_us_el' => 'required',
        'revisado' => 'required|string|max:1',
        'trasnfe' => 'required|string|max:1',
        'co_sucu' => 'required|string|max:6',
        'rowguid' => 'required|string',
        'row_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function clientes()
    {
        return $this->hasMany(\App\Models\Sincronizador\Cliente::class, 'tipo');
    }
}
