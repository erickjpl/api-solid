<?php

namespace Epl\Campana\Domain\Entities;

use Epl\Campana\Domain\Exceptions\ModelNotFound;

final class CampanaEntity
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

    public function __construct(
        string $campana,
        string $audiencia,
        int $step,
        string $status,
        string $name = null,
        string $email = null,
        string $asunto = null,
        string $fecha = null,
        string $lista = null,
        string $template = null,
        int $id = null
    )
    {
        $this->id = $id;
        $this->campana = $campana;
        $this->from_name = $name;
        $this->from_email = $email;
        $this->asunto = $asunto;
        $this->fecha = $fecha;
        $this->status = $status;
        $this->lista = $lista;
        $this->total_audiencia = $audiencia;
        $this->step = $step;
        $this->email = $template;
    }

    public static function map($data): self
    {
        if (!$data)
            throw new ModelNotFound();

        return new self(
            $data->campana,
            $data->total_audiencia,
            $data->step,
            $data->status,
            $data->from_name,
            $data->from_email,
            $data->asunto,
            $data->fecha,
            $data->lista,
            $data->email,
            $data->id
        );
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

    public function toCollect()
    {
        return collect($this->toArray());
    }

    public function toJson()
    {
        return (object) $this->toArray();
    }

    public function toArray()
    {
        return array(
            'id' => $this->getId(),
            'campana' => $this->getCampana(),
            'from_name' => $this->getFromName(),
            'from_email' => $this->getFromEmail(),
            'asunto' => $this->getAsunto(),
            'fecha' => $this->getFecha(),
            'status' => $this->getStatus(),
            'lista' => $this->getLista(),
            'total_audiencia' => $this->getTotalAudiencia(),
            'step' => $this->getStep(),
            'email' => $this->getEmail()
        );
    }
}
