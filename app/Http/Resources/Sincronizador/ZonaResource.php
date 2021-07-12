<?php

namespace App\Http\Resources\Sincronizador;

use Illuminate\Http\Resources\Json\JsonResource;

class ZonaResource extends JsonResource
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
            'co_zon' => $this->co_zon,
            'zon_des' => $this->zon_des,
            'dis_cen' => $this->dis_cen,
            'campo1' => $this->campo1,
            'campo2' => $this->campo2,
            'campo3' => $this->campo3,
            'campo4' => $this->campo4,
            'co_us_in' => $this->co_us_in,
            'fe_us_in' => $this->fe_us_in,
            'co_us_mo' => $this->co_us_mo,
            'fe_us_mo' => $this->fe_us_mo,
            'co_us_el' => $this->co_us_el,
            'fe_us_el' => $this->fe_us_el,
            'revisado' => $this->revisado,
            'trasnfe' => $this->trasnfe,
            'co_sucu' => $this->co_sucu,
            'rowguid' => $this->rowguid
        ];
    }
}
