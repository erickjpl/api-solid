<?php

namespace App\Models\Configuracion;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Connection
 * @package App\Models\Configuracion
 * @version July 11, 2021, 4:33 pm -04
 *
 * @property string $shop
 * @property string $start_date
 * @property string $status
 */
class Connection extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'connections';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

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
        'status' => 'required|string|max:1',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
