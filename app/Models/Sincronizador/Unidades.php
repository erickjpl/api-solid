<?php

namespace App\Models\Sincronizador;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Unidades
 * @package App\Models\Sincronizador
 *
 * @property \Illuminate\Database\Eloquent\Collection $art
 * @property \Illuminate\Database\Eloquent\Collection $art1s
 * @property \Illuminate\Database\Eloquent\Collection $rengEmbs
 * @property string $des_uni
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
class Unidades extends Model
{
    use HasFactory;

    public $table = 'unidades';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $connection = "sqlsrv";

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['row_id'];

    public $fillable = [
        'des_uni',
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
        'co_uni' => 'string',
        'des_uni' => 'string',
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
        'des_uni' => 'required|string|max:60',
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
    public function art()
    {
        return $this->hasMany(\App\Models\Sincronizador\Art::class, 'uni_venta');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function art1s()
    {
        return $this->hasMany(\App\Models\Sincronizador\Art::class, 'suni_venta');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function rengEmbs()
    {
        return $this->hasMany(\App\Models\Sincronizador\RengEmb::class, 'co_uni');
    }
}
