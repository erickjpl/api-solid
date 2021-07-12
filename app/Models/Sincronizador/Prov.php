<?php

namespace App\Models\Sincronizador;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Prov
 * @package App\Models\Sincronizador
 * @version July 11, 2021, 10:23 am -04
 *
 * @property \App\Models\Sincronizador\CtaIngr $coIngr
 * @property \App\Models\Sincronizador\Segmento $coSeg
 * @property \App\Models\Sincronizador\TipoPro $tipo
 * @property \App\Models\Sincronizador\Zona $coZon
 * @property \Illuminate\Database\Eloquent\Collection $art
 * @property \Illuminate\Database\Eloquent\Collection $compras
 * @property \Illuminate\Database\Eloquent\Collection $cotizPs
 * @property \Illuminate\Database\Eloquent\Collection $devPros
 * @property \Illuminate\Database\Eloquent\Collection $documCps
 * @property \Illuminate\Database\Eloquent\Collection $imports
 * @property \Illuminate\Database\Eloquent\Collection $notRecs
 * @property \Illuminate\Database\Eloquent\Collection $ordenes
 * @property \Illuminate\Database\Eloquent\Collection $pagos
 * @property \Illuminate\Database\Eloquent\Collection $placoms
 * @property \Illuminate\Database\Eloquent\Collection $monedas
 * @property \Illuminate\Database\Eloquent\Collection $transpors
 * @property string $prov_des
 * @property string $co_seg
 * @property string $co_zon
 * @property boolean $inactivo
 * @property string $productos
 * @property string $direc1
 * @property string $direc2
 * @property string $telefonos
 * @property string $fax
 * @property string $respons
 * @property string|\Carbon\Carbon $fecha_reg
 * @property string $tipo
 * @property integer $com_ult_co
 * @property string|\Carbon\Carbon $fec_ult_co
 * @property number $net_ult_co
 * @property number $saldo
 * @property number $saldo_ini
 * @property number $mont_cre
 * @property integer $plaz_pag
 * @property number $desc_ppago
 * @property number $desc_glob
 * @property string $tipo_iva
 * @property number $iva
 * @property string $rif
 * @property boolean $nacional
 * @property string $dis_cen
 * @property string $nit
 * @property string $email
 * @property string $co_ingr
 * @property string $comentario
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
 * @property boolean $juridico
 * @property number $tipo_adi
 * @property string $matriz
 * @property integer $co_tab
 * @property string $tipo_per
 * @property string $co_pais
 * @property string $ciudad
 * @property string $zip
 * @property string $website
 * @property string $formtype
 * @property string $taxid
 * @property number $porc_esp
 * @property boolean $contribu_e
 */
class Prov extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'prov';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $connection = "sqlsrv";

    public $fillable = [
        'prov_des',
        'co_seg',
        'co_zon',
        'inactivo',
        'productos',
        'direc1',
        'direc2',
        'telefonos',
        'fax',
        'respons',
        'fecha_reg',
        'tipo',
        'com_ult_co',
        'fec_ult_co',
        'net_ult_co',
        'saldo',
        'saldo_ini',
        'mont_cre',
        'plaz_pag',
        'desc_ppago',
        'desc_glob',
        'tipo_iva',
        'iva',
        'rif',
        'nacional',
        'dis_cen',
        'nit',
        'email',
        'co_ingr',
        'comentario',
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
        'juridico',
        'tipo_adi',
        'matriz',
        'co_tab',
        'tipo_per',
        'co_pais',
        'ciudad',
        'zip',
        'website',
        'formtype',
        'taxid',
        'porc_esp',
        'contribu_e'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'co_prov' => 'string',
        'prov_des' => 'string',
        'co_seg' => 'string',
        'co_zon' => 'string',
        'inactivo' => 'boolean',
        'productos' => 'string',
        'direc1' => 'string',
        'direc2' => 'string',
        'telefonos' => 'string',
        'fax' => 'string',
        'respons' => 'string',
        'fecha_reg' => 'datetime',
        'tipo' => 'string',
        'com_ult_co' => 'integer',
        'fec_ult_co' => 'datetime',
        'net_ult_co' => 'decimal:2',
        'saldo' => 'decimal:2',
        'saldo_ini' => 'decimal:2',
        'mont_cre' => 'decimal:2',
        'plaz_pag' => 'integer',
        'desc_ppago' => 'decimal:2',
        'desc_glob' => 'decimal:2',
        'tipo_iva' => 'string',
        'iva' => 'decimal:2',
        'rif' => 'string',
        'nacional' => 'boolean',
        'dis_cen' => 'string',
        'nit' => 'string',
        'email' => 'string',
        'co_ingr' => 'string',
        'comentario' => 'string',
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
        'juridico' => 'boolean',
        'tipo_adi' => 'decimal:0',
        'matriz' => 'string',
        'co_tab' => 'integer',
        'tipo_per' => 'string',
        'co_pais' => 'string',
        'ciudad' => 'string',
        'zip' => 'string',
        'website' => 'string',
        'formtype' => 'string',
        'taxid' => 'string',
        'porc_esp' => 'float',
        'contribu_e' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'prov_des' => 'required|string|max:100',
        'co_seg' => 'required|string|max:6',
        'co_zon' => 'required|string|max:6',
        'inactivo' => 'required|boolean',
        'productos' => 'required|string|max:60',
        'direc1' => 'required|string',
        'direc2' => 'required|string|max:60',
        'telefonos' => 'required|string|max:60',
        'fax' => 'required|string|max:60',
        'respons' => 'required|string|max:60',
        'fecha_reg' => 'required',
        'tipo' => 'required|string|max:6',
        'com_ult_co' => 'required|integer',
        'fec_ult_co' => 'required',
        'net_ult_co' => 'required|numeric',
        'saldo' => 'required|numeric',
        'saldo_ini' => 'required|numeric',
        'mont_cre' => 'required|numeric',
        'plaz_pag' => 'required|integer',
        'desc_ppago' => 'required|numeric',
        'desc_glob' => 'required|numeric',
        'tipo_iva' => 'required|string|max:1',
        'iva' => 'required|numeric',
        'rif' => 'required|string|max:18',
        'nacional' => 'required|boolean',
        'dis_cen' => 'required|string',
        'nit' => 'required|string|max:18',
        'email' => 'required|string|max:60',
        'co_ingr' => 'required|string|max:6',
        'comentario' => 'required|string',
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
        'juridico' => 'required|boolean',
        'tipo_adi' => 'required|numeric',
        'matriz' => 'required|string|max:10',
        'co_tab' => 'required|integer',
        'tipo_per' => 'required|string|max:1',
        'co_pais' => 'required|string|max:6',
        'ciudad' => 'required|string|max:50',
        'zip' => 'required|string|max:10',
        'website' => 'required|string|max:200',
        'formtype' => 'required|string|max:30',
        'taxid' => 'required|string|max:20',
        'porc_esp' => 'required|numeric',
        'contribu_e' => 'required|boolean'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function coIngr()
    {
        return $this->belongsTo(\App\Models\Sincronizador\CtaIngr::class, 'co_ingr');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function coSeg()
    {
        return $this->belongsTo(\App\Models\Sincronizador\Segmento::class, 'co_seg');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tipo()
    {
        return $this->belongsTo(\App\Models\Sincronizador\TipoPro::class, 'tipo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function coZon()
    {
        return $this->belongsTo(\App\Models\Sincronizador\Zona::class, 'co_zon');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function art()
    {
        return $this->hasMany(\App\Models\Sincronizador\Art::class, 'co_prov');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function compras()
    {
        return $this->hasMany(\App\Models\Sincronizador\Compra::class, 'co_cli');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function cotizPs()
    {
        return $this->hasMany(\App\Models\Sincronizador\CotizP::class, 'co_cli');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function devPros()
    {
        return $this->hasMany(\App\Models\Sincronizador\DevPro::class, 'co_cli');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function documCps()
    {
        return $this->hasMany(\App\Models\Sincronizador\DocumCp::class, 'co_cli');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function imports()
    {
        return $this->belongsToMany(\App\Models\Sincronizador\Import::class, 'exp_imp');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function notRecs()
    {
        return $this->hasMany(\App\Models\Sincronizador\NotRec::class, 'co_cli');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function ordenes()
    {
        return $this->hasMany(\App\Models\Sincronizador\Ordene::class, 'co_cli');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function pagos()
    {
        return $this->hasMany(\App\Models\Sincronizador\Pago::class, 'co_cli');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function placoms()
    {
        return $this->hasMany(\App\Models\Sincronizador\Placom::class, 'co_cli');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function monedas()
    {
        return $this->belongsToMany(\App\Models\Sincronizador\Moneda::class, 'rma_entp');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function transpors()
    {
        return $this->belongsToMany(\App\Models\Sincronizador\Transpor::class, 'rma_prov');
    }
}
