<?php

namespace App\Models\Sincronizador;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Vendedor
 * @package App\Models\Sincronizador
 *
 * @property \Illuminate\Database\Eloquent\Collection $clientes
 * @property \Illuminate\Database\Eloquent\Collection $cobros
 * @property \Illuminate\Database\Eloquent\Collection $cotizCs
 * @property \Illuminate\Database\Eloquent\Collection $devClis
 * @property \Illuminate\Database\Eloquent\Collection $documCcs
 * @property \Illuminate\Database\Eloquent\Collection $facturas
 * @property \Illuminate\Database\Eloquent\Collection $notDeps
 * @property \Illuminate\Database\Eloquent\Collection $notEnts
 * @property \Illuminate\Database\Eloquent\Collection $pedidos
 * @property \Illuminate\Database\Eloquent\Collection $plavents
 * @property string $tipo
 * @property string $ven_des
 * @property string $dis_cen
 * @property string $cedula
 * @property string $direc1
 * @property string $direc2
 * @property string $telefonos
 * @property string|\Carbon\Carbon $fecha_reg
 * @property boolean $condic
 * @property number $comision
 * @property string $comen
 * @property boolean $fun_cob
 * @property boolean $fun_ven
 * @property number $comisionv
 * @property integer $fac_ult_ve
 * @property string|\Carbon\Carbon $fec_ult_ve
 * @property number $net_ult_ve
 * @property string $cli_ult_ve
 * @property string $cta_contab
 * @property string $campo1
 * @property string $campo2
 * @property string $campo3
 * @property string $campo4
 * @property string $campo5
 * @property string $campo6
 * @property string $campo7
 * @property string $campo8
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
 * @property string $login
 * @property string $password
 * @property string $email
 * @property string $PSW_M
 */
class Vendedor extends Model
{
    use HasFactory;

    public $table = 'vendedor';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $connection = "sqlsrv";

    public $fillable = [
        'tipo',
        'ven_des',
        'dis_cen',
        'cedula',
        'direc1',
        'direc2',
        'telefonos',
        'fecha_reg',
        'condic',
        'comision',
        'comen',
        'fun_cob',
        'fun_ven',
        'comisionv',
        'fac_ult_ve',
        'fec_ult_ve',
        'net_ult_ve',
        'cli_ult_ve',
        'cta_contab',
        'campo1',
        'campo2',
        'campo3',
        'campo4',
        'campo5',
        'campo6',
        'campo7',
        'campo8',
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
        'login',
        'password',
        'email',
        'PSW_M'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'co_ven' => 'string',
        'tipo' => 'string',
        'ven_des' => 'string',
        'dis_cen' => 'string',
        'cedula' => 'string',
        'direc1' => 'string',
        'direc2' => 'string',
        'telefonos' => 'string',
        'fecha_reg' => 'datetime',
        'condic' => 'boolean',
        'comision' => 'decimal:2',
        'comen' => 'string',
        'fun_cob' => 'boolean',
        'fun_ven' => 'boolean',
        'comisionv' => 'decimal:2',
        'fac_ult_ve' => 'integer',
        'fec_ult_ve' => 'datetime',
        'net_ult_ve' => 'decimal:2',
        'cli_ult_ve' => 'string',
        'cta_contab' => 'string',
        'campo1' => 'string',
        'campo2' => 'string',
        'campo3' => 'string',
        'campo4' => 'string',
        'campo5' => 'string',
        'campo6' => 'string',
        'campo7' => 'string',
        'campo8' => 'string',
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
        'login' => 'string',
        'password' => 'string',
        'email' => 'string',
        'PSW_M' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'tipo' => 'required|string|max:1',
        'ven_des' => 'required|string|max:60',
        'dis_cen' => 'required|string',
        'cedula' => 'required|string|max:16',
        'direc1' => 'required|string|max:60',
        'direc2' => 'required|string|max:60',
        'telefonos' => 'required|string|max:60',
        'fecha_reg' => 'required',
        'condic' => 'required|boolean',
        'comision' => 'required|numeric',
        'comen' => 'required|string',
        'fun_cob' => 'required|boolean',
        'fun_ven' => 'required|boolean',
        'comisionv' => 'required|numeric',
        'fac_ult_ve' => 'required|integer',
        'fec_ult_ve' => 'required',
        'net_ult_ve' => 'required|numeric',
        'cli_ult_ve' => 'required|string|max:6',
        'cta_contab' => 'required|string|max:20',
        'campo1' => 'required|string|max:60',
        'campo2' => 'required|string|max:60',
        'campo3' => 'required|string|max:60',
        'campo4' => 'required|string|max:60',
        'campo5' => 'required|string|max:60',
        'campo6' => 'required|string|max:60',
        'campo7' => 'required|string|max:60',
        'campo8' => 'required|string|max:60',
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
        'login' => 'required|string|max:10',
        'password' => 'required|string|max:50',
        'email' => 'required|string|max:40',
        'PSW_M' => 'required|string|max:20'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function clientes()
    {
        return $this->hasMany(\App\Models\Sincronizador\Cliente::class, 'co_ven');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function cobros()
    {
        return $this->hasMany(\App\Models\Sincronizador\Cobro::class, 'co_ven');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function cotizCs()
    {
        return $this->hasMany(\App\Models\Sincronizador\CotizC::class, 'co_ven');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function devClis()
    {
        return $this->hasMany(\App\Models\Sincronizador\DevCli::class, 'co_ven');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function documCcs()
    {
        return $this->hasMany(\App\Models\Sincronizador\DocumCc::class, 'co_ven');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function facturas()
    {
        return $this->hasMany(\App\Models\Sincronizador\Factura::class, 'co_ven');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function notDeps()
    {
        return $this->hasMany(\App\Models\Sincronizador\NotDep::class, 'co_ven');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function notEnts()
    {
        return $this->hasMany(\App\Models\Sincronizador\NotEnt::class, 'co_ven');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function pedidos()
    {
        return $this->hasMany(\App\Models\Sincronizador\Pedido::class, 'co_ven');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function plavents()
    {
        return $this->hasMany(\App\Models\Sincronizador\Plavent::class, 'co_ven');
    }
}
