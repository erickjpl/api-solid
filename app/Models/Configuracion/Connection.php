<?php

namespace App\Models\Configuracion;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Connection
 * @package App\Models\Configuracion
 *
 * @property string $shop
 * @property string $start_date
 * @property string $status
 */
class Connection extends Model
{
    use HasFactory;

    public $table = 'connections';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $connection = "mysql";

    public $fillable = [
        'shop',
        'start_date',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'shop' => 'string',
        'start_date' => 'date',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'shop' => 'required|string|max:180',
        'start_date' => 'required',
        'status' => 'required|string|max:1'
    ];    
}
