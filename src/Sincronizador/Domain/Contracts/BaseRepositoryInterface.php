<?php

namespace Epl\Sincronizador\Domain\Contracts;

interface BaseRepositoryInterface
{
    /**
     * Make Model instance
     */
    public function makeModel();

    /**
     * Paginate records for scaffold.
     */
    public function paginate($perPage, $columns = ['*']);

    /**
     * Build a query for retrieving all records.
     */
    public function allQuery($search = [], $skip = null, $limit = null);

    /**
     * Retrieve all records with given filter criteria
     */
    public function all($search = [], $skip = null, $limit = null, $columns = ['*']);

    /**
     * Create model record
     */
    public function create($input);

    /**
     * Find model record for given id
     */
    public function find($id, $columns = ['*']);

    /**
     * Find model record with given filter criteria
     */
    public function first($search = [], $columns = ['*']);

    /**
     * Update model record for given id
     */
    public function update($input, $id);

    /**
     * Delete model record for given id
     */
    public function delete($id);
}
