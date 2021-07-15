<?php

namespace Epl\Sincronizador\Domain\Entities;

final class ConnectionEntity
{
  private $id;
  private $shop;
  private $status;
  private $start_date;

  private function __construct(string $id, string $shop, string $start_date, string $status)
  {
    $this->id = $id;
    $this->shop = $shop;
    $this->status = $status;
    $this->start_date = $start_date;
  }

  /**
   * Get the value of id
   */ 
  public function getId()
  {
    return $this->id;
  }

  /**
   * Get the value of start_date
   */ 
  public function getShop()
  {
    return $this->shop;
  }

  /**
   * Get the value of start_date
   */ 
  public function getStartDate()
  {
    return $this->start_date;
  }

  /**
   * Get the value of status
   */ 
  public function getStatus()
  {
    return $this->status;
  }

  public static function fromDto($responseDTO): ConnectionEntity
  {
    return new ConnectionEntity($responseDTO->id, $responseDTO->shop, $responseDTO->start_date, $responseDTO->status);
  }
  
  // public function toDto()
  // {
  //   return new CreateProductResponseDto(
  //     $this->id,
  //     $this->name, $this->reference, $this->createdAt
  //   );
  // }
}
