<?php

namespace Epl\Campana\Domain\Entities;

final class ConnectionEntity
{
  private $id;
  private $status;
  private $start_date;

  private function __construct(string $id, string $status, string $start_date)
  {
    $this->id = $id;
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
   * Get the value of status
   */ 
  public function getStatus()
  {
    return $this->status;
  }

  /**
   * Get the value of start_date
   */ 
  public function getStartDate()
  {
    return $this->start_date;
  }

  public static function fromDto($responseDTO): ConnectionEntity
  {
    try {
      return new ConnectionEntity($responseDTO->id, $responseDTO->status, $responseDTO->start_date);
    } catch (\Exception $exception) {
      throw $exception;
    }
  }
  
  // public function toDto()
  // {
  //   return new CreateProductResponseDto(
  //     $this->id,
  //     $this->name, $this->reference, $this->createdAt
  //   );
  // }
}
