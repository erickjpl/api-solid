<?php

namespace App\Http\Resources\Marketing;

use Illuminate\Http\Resources\Json\JsonResource;

class CampanaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'campana' => $this->campana,
            'from_name' => $this->from_name,
            'from_email' => $this->from_email,
            'asunto' => $this->asunto,
            'fecha' => $this->fecha,
            'status' => $this->status,
            'lista' => $this->lista,
            'total_audiencia' => $this->total_audiencia,
            'step' => $this->step,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
