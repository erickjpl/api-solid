<?php

namespace App\Models\Marketing;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Campana
 * @package App\Models\Marketing
 * @version June 24, 2021, 5:55 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection $campanaDetalles
 * @property \Illuminate\Database\Eloquent\Collection $campanaEventos
 * @property string $campana
 * @property string $from_name
 * @property string $from_email
 * @property string $asunto
 * @property string|\Carbon\Carbon $fecha
 * @property string $status
 * @property string $lista
 * @property integer $total_audiencia
 * @property integer $step
 * @property string $email
 */
class Campana extends Model
{
    # use SoftDeletes;

    use HasFactory;

    public $table = 'campanas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    # protected $dates = ['deleted_at'];



    public $fillable = [
        'campana',
        'from_name',
        'from_email',
        'asunto',
        'fecha',
        'status',
        'lista',
        'total_audiencia',
        'step',
        'email'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'campana' => 'string',
        'from_name' => 'string',
        'from_email' => 'string',
        'asunto' => 'string',
        'fecha' => 'datetime',
        'status' => 'string',
        'lista' => 'string',
        'total_audiencia' => 'integer',
        'step' => 'integer',
        'email' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'campana' => 'required|string|max:191',
        'from_name' => 'nullable|string|max:191',
        'from_email' => 'nullable|string|max:191',
        'asunto' => 'nullable|string|max:191',
        'fecha' => 'nullable',
        'status' => 'required|string',
        'lista' => 'nullable|string|max:191',
        'total_audiencia' => 'required|integer',
        'step' => 'required|integer',
        'email' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function campanaDetalles()
    {
        return $this->hasMany(\App\Models\Marketing\CampanaDetalle::class, 'campana_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function campanaEventos()
    {
        return $this->hasMany(\App\Models\Marketing\CampanaEvento::class, 'campana_id');
    }
}
