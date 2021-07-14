<?php

namespace App\Models\Sincronizador;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CtaIngr
 * @package App\Models\Sincronizador
 *
 * @property \Illuminate\Database\Eloquent\Collection $clientes
 * @property \Illuminate\Database\Eloquent\Collection $depCajs
 * @property \Illuminate\Database\Eloquent\Collection $movBans
 * @property \Illuminate\Database\Eloquent\Collection $movCajs
 * @property \Illuminate\Database\Eloquent\Collection $ordPagos
 * @property \Illuminate\Database\Eloquent\Collection $provs
 * @property \Illuminate\Database\Eloquent\Collection $rengOpgs
 * @property string $descrip
 * @property string $cta_contab
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
 * @property string $co_islr
 */
class CtaIngr extends Model
{
    use HasFactory;

    public $table = 'cta_ingr';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $connection = "sqlsrv";

    public $fillable = [
        'descrip',
        'cta_contab',
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
        'rowguid',
        'co_islr'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'co_ingr' => 'string',
        'descrip' => 'string',
        'cta_contab' => 'string',
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
        'rowguid' => 'string',
        'co_islr' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'descrip' => 'required|string|max:60',
        'cta_contab' => 'required|string|max:20',
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
        'rowguid' => 'required|string',
        'co_islr' => 'required|string|max:6'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function clientes()
    {
        return $this->hasMany(\App\Models\Sincronizador\Cliente::class, 'co_ingr');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function depCajs()
    {
        return $this->hasMany(\App\Models\Sincronizador\DepCaj::class, 'cta_egre');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function movBans()
    {
        return $this->hasMany(\App\Models\Sincronizador\MovBan::class, 'cta_egre');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function movCajs()
    {
        return $this->hasMany(\App\Models\Sincronizador\MovCaj::class, 'cta_egre');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function ordPagos()
    {
        return $this->hasMany(\App\Models\Sincronizador\OrdPago::class, 'cta_egre');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function provs()
    {
        return $this->hasMany(\App\Models\Sincronizador\Prov::class, 'co_ingr');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function rengOpgs()
    {
        return $this->hasMany(\App\Models\Sincronizador\RengOpg::class, 'cta_egre');
    }
}
