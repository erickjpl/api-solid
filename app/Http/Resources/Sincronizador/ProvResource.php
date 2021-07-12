<?php

namespace App\Http\Resources\Sincronizador;

use Illuminate\Http\Resources\Json\JsonResource;

class ProvResource extends JsonResource
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
            'co_prov' => $this->co_prov,
            'prov_des' => $this->prov_des,
            'co_seg' => $this->co_seg,
            'co_zon' => $this->co_zon,
            'inactivo' => $this->inactivo,
            'productos' => $this->productos,
            'direc1' => $this->direc1,
            'direc2' => $this->direc2,
            'telefonos' => $this->telefonos,
            'fax' => $this->fax,
            'respons' => $this->respons,
            'fecha_reg' => $this->fecha_reg,
            'tipo' => $this->tipo,
            'com_ult_co' => $this->com_ult_co,
            'fec_ult_co' => $this->fec_ult_co,
            'net_ult_co' => $this->net_ult_co,
            'saldo' => $this->saldo,
            'saldo_ini' => $this->saldo_ini,
            'mont_cre' => $this->mont_cre,
            'plaz_pag' => $this->plaz_pag,
            'desc_ppago' => $this->desc_ppago,
            'desc_glob' => $this->desc_glob,
            'tipo_iva' => $this->tipo_iva,
            'iva' => $this->iva,
            'rif' => $this->rif,
            'nacional' => $this->nacional,
            'dis_cen' => $this->dis_cen,
            'nit' => $this->nit,
            'email' => $this->email,
            'co_ingr' => $this->co_ingr,
            'comentario' => $this->comentario,
            'campo1' => $this->campo1,
            'campo2' => $this->campo2,
            'campo3' => $this->campo3,
            'campo4' => $this->campo4,
            'campo5' => $this->campo5,
            'campo6' => $this->campo6,
            'campo7' => $this->campo7,
            'campo8' => $this->campo8,
            'co_us_in' => $this->co_us_in,
            'fe_us_in' => $this->fe_us_in,
            'co_us_mo' => $this->co_us_mo,
            'fe_us_mo' => $this->fe_us_mo,
            'co_us_el' => $this->co_us_el,
            'fe_us_el' => $this->fe_us_el,
            'revisado' => $this->revisado,
            'trasnfe' => $this->trasnfe,
            'co_sucu' => $this->co_sucu,
            'rowguid' => $this->rowguid,
            'juridico' => $this->juridico,
            'tipo_adi' => $this->tipo_adi,
            'matriz' => $this->matriz,
            'co_tab' => $this->co_tab,
            'tipo_per' => $this->tipo_per,
            'co_pais' => $this->co_pais,
            'ciudad' => $this->ciudad,
            'zip' => $this->zip,
            'website' => $this->website,
            'formtype' => $this->formtype,
            'taxid' => $this->taxid,
            'porc_esp' => $this->porc_esp,
            'contribu_e' => $this->contribu_e
        ];
    }
}
