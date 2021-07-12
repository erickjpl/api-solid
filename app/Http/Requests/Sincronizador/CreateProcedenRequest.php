<?php

namespace App\Http\Requests\Sincronizador;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Sincronizador\Proceden;

class CreateProcedenRequest extends FormRequest
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
        return Proceden::$rules;
    }
}
