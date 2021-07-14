<?php

namespace App\Models\Sincronizador;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Segmento
 * @package App\Models\Sincronizador
 *
 * @property \Illuminate\Database\Eloquent\Collection $clientes
 * @property \Illuminate\Database\Eloquent\Collection $provs
 * @property string $seg_des
 * @property string $c_cuenta
 * @property string $p_cuenta
 * @property string $dis_cen
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
 */
class Segmento extends Model
{
    use HasFactory;

    public $table = 'segmento';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $connection = "sqlsrv";

    public $fillable = [
        'seg_des',
        'c_cuenta',
        'p_cuenta',
        'dis_cen',
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
        'rowguid'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'co_seg' => 'string',
        'seg_des' => 'string',
        'c_cuenta' => 'string',
        'p_cuenta' => 'string',
        'dis_cen' => 'string',
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
        'rowguid' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'seg_des' => 'required|string|max:60',
        'c_cuenta' => 'required|string|max:20',
        'p_cuenta' => 'required|string|max:20',
        'dis_cen' => 'required|string',
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
        'rowguid' => 'required|string'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function clientes()
    {
        return $this->hasMany(\App\Models\Sincronizador\Cliente::class, 'co_seg');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function provs()
    {
        return $this->hasMany(\App\Models\Sincronizador\Prov::class, 'co_seg');
    }
}
