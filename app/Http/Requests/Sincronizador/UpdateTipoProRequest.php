<?php

namespace App\Http\Requests\Sincronizador;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Sincronizador\TipoPro;

class UpdateTipoProRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = TipoPro::$rules;
        
        return $rules;
    }
}
