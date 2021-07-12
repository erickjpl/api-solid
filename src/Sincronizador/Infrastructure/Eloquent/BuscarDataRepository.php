<?php

namespace Epl\Campana\Infrastructure\Eloquent;

use App\Repositories\BaseRepository;
use App\Models\Configuracion\Connection;
use Epl\Sincronizador\Domain\Contracts\BuscarDataIRepository;

final class BuscarDataRepository extends BaseRepository implements BuscarDataIRepository
{
  /**
   * @var array
   */
  protected $fieldSearchable = [];

  /**
   * Return searchable fields
   *
   * @return array
   */
  public function getFieldsSearchable()
  {
    return $this->fieldSearchable;
  }

  /**
   * Configure the Model
   **/
  public function model()
  {
    return Connection::class;
  }
}
