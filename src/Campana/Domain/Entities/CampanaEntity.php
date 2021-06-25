<?php

namespace Epl\Campana\Domain\Entities;

final class CampanaEntity implements Command
{
    private $id;
    private $campana;
    private $from_name;
    private $from_email;
    private $asunto;
    private $fecha;
    private $status;
    private $lista;
    private $total_audiencia;
    private $step;
    private $email;

    public function __construct($id, $campana, $name, $email, $asunto, $fecha, $status, $lista, $audiencia, $step, $template)
    {
        $this->id = $id;
        $this->campana = $campana;
        $this->from_name = $name;
        $this->from_email = $email;
        $this->asunto = $asunto;
        $this->fecha = $fecha;
        $this->status = $status;
        $this->lista = $lista;
        $this->total_audiencia = $total_audiencia;
        $this->step = $step;
        $this->email = $template;
    }

    public function getId() {
        return $this->id;
    }
    
    public function getCampana() {
        return $this->campana;
    }
    
    public function getFromName() {
        return $this->from_name;
    }
    
    public function getFromEmail() {
        return $this->from_email;
    }
    
    public function getAsunto() {
        return $this->asunto;
    }
    
    public function getFecha() {
        return $this->fecha;
    }
    
    public function getStatus() {
        return $this->status;
    }
    
    public function getLista() {
        return $this->lista;
    }
    
    public function getTotalAudiencia() {
        return $this->total_audiencia;
    }
    
    public function getStep() {
        return $this->step;
    }
    
    public function getEmail() {
        return $this->email;
    }
}
