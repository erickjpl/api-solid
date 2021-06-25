<?php

namespace App\Http\Requests\Marketing;

use App\Models\Marketing\Campana;
use InfyOm\Generator\Request\APIRequest;

class CreateCampanaAPIRequest extends APIRequest
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
        return Campana::$rules;
    }
}
