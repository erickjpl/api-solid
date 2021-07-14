<?php

namespace App\Models\Sincronizador;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Tabulado
 * @package App\Models\Sincronizador
 *
 * @property \Illuminate\Database\Eloquent\Collection $art
 * @property \Illuminate\Database\Eloquent\Collection $documCcs
 * @property \Illuminate\Database\Eloquent\Collection $documCps
 * @property \Illuminate\Database\Eloquent\Collection $rengCacs
 * @property \Illuminate\Database\Eloquent\Collection $rengDvcs
 * @property \Illuminate\Database\Eloquent\Collection $rengFacs
 * @property \Illuminate\Database\Eloquent\Collection $rengNdds
 * @property \Illuminate\Database\Eloquent\Collection $rengPeds
 * @property string $descripcio
 * @property number $porc_vent
 * @property number $porc_comp
 * @property number $porc_cxs
 * @property number $porc_otro
 * @property string $revisado
 * @property string $trasnfe
 * @property string $rowguid
 */
class Tabulado extends Model
{
    use HasFactory;

    public $table = 'tabulado';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $connection = "sqlsrv";

    public $fillable = [
        'descripcio',
        'porc_vent',
        'porc_comp',
        'porc_cxs',
        'porc_otro',
        'revisado',
        'trasnfe',
        'rowguid'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'tipo' => 'string',
        'descripcio' => 'string',
        'porc_vent' => 'decimal:3',
        'porc_comp' => 'decimal:3',
        'porc_cxs' => 'decimal:3',
        'porc_otro' => 'decimal:3',
        'revisado' => 'string',
        'trasnfe' => 'string',
        'rowguid' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'descripcio' => 'required|string|max:60',
        'porc_vent' => 'required|numeric',
        'porc_comp' => 'required|numeric',
        'porc_cxs' => 'required|numeric',
        'porc_otro' => 'required|numeric',
        'revisado' => 'required|string|max:1',
        'trasnfe' => 'required|string|max:1',
        'rowguid' => 'required|string'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function art()
    {
        return $this->hasMany(\App\Models\Sincronizador\Art::class, 'tipo_imp');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function documCcs()
    {
        return $this->hasMany(\App\Models\Sincronizador\DocumCc::class, 'tipo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function documCps()
    {
        return $this->hasMany(\App\Models\Sincronizador\DocumCp::class, 'tipo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function rengCacs()
    {
        return $this->hasMany(\App\Models\Sincronizador\RengCac::class, 'tipo_imp');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function rengDvcs()
    {
        return $this->hasMany(\App\Models\Sincronizador\RengDvc::class, 'tipo_imp');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function rengFacs()
    {
        return $this->hasMany(\App\Models\Sincronizador\RengFac::class, 'tipo_imp');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function rengNdds()
    {
        return $this->hasMany(\App\Models\Sincronizador\RengNdd::class, 'tipo_imp');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function rengPeds()
    {
        return $this->hasMany(\App\Models\Sincronizador\RengPed::class, 'tipo_imp');
    }
}
