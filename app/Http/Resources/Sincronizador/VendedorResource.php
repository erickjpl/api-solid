<?php

namespace App\Http\Resources\Sincronizador;

use Illuminate\Http\Resources\Json\JsonResource;

class VendedorResource extends JsonResource
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
            'co_ven' => $this->co_ven,
            'tipo' => $this->tipo,
            'ven_des' => $this->ven_des,
            'dis_cen' => $this->dis_cen,
            'cedula' => $this->cedula,
            'direc1' => $this->direc1,
            'direc2' => $this->direc2,
            'telefonos' => $this->telefonos,
            'fecha_reg' => $this->fecha_reg,
            'condic' => $this->condic,
            'comision' => $this->comision,
            'comen' => $this->comen,
            'fun_cob' => $this->fun_cob,
            'fun_ven' => $this->fun_ven,
            'comisionv' => $this->comisionv,
            'fac_ult_ve' => $this->fac_ult_ve,
            'fec_ult_ve' => $this->fec_ult_ve,
            'net_ult_ve' => $this->net_ult_ve,
            'cli_ult_ve' => $this->cli_ult_ve,
            'cta_contab' => $this->cta_contab,
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
            'login' => $this->login,
            'password' => $this->password,
            'email' => $this->email,
            'PSW_M' => $this->PSW_M
        ];
    }
}
