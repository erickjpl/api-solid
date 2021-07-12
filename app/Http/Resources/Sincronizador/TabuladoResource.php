<?php

namespace App\Http\Resources\Sincronizador;

use Illuminate\Http\Resources\Json\JsonResource;

class TabuladoResource extends JsonResource
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
            'tipo' => $this->tipo,
            'descripcio' => $this->descripcio,
            'porc_vent' => $this->porc_vent,
            'porc_comp' => $this->porc_comp,
            'porc_cxs' => $this->porc_cxs,
            'porc_otro' => $this->porc_otro,
            'revisado' => $this->revisado,
            'trasnfe' => $this->trasnfe,
            'rowguid' => $this->rowguid
        ];
    }
}
