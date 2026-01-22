<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;


/**
 * Class BaseRepository
 *
 * Provides common CRUD operations for repositories.
 */
abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected Model $model;
    protected Builder $query;


    /**
     * BaseRepository constructor.
     */
    public function __construct()
    {
        $this->model = app($this->model());
        $this->query = $this->model->newQuery();
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    abstract public function model(): string;

    /**
     * Return searchable fields (for filters, search).
     *
     * @return array
     */
    abstract public function getFieldsSearchable(): array;

    /**
     * Get all records.
     *
     * @param array $criteria
     * @param int|null $skip
     * @param int|null $limit
     * @return Collection
     */

     public function with(array $relations): self
{
    $this->query = $this->query->with($relations);
    return $this;
}


public function paginate(int $perPage = 15): LengthAwarePaginator
{
    return $this->query->paginate($perPage);
}

    public function all(array $criteria = [], ?int $skip = null, ?int $limit = null): Collection
    {
        $query = $this->model->newQuery();

        foreach ($criteria as $field => $value) {
            if (in_array($field, $this->getFieldsSearchable())) {
                $query->where($field, $value);
            }
        }

        if (!is_null($skip)) {
            $query->skip($skip);
        }

        if (!is_null($limit)) {
            $query->take($limit);
        }

        return $query->get();
    }

    /**
     * Find a record by ID.
     *
     * @param int $id
     * @return Model|null
     */
    public function find(int $id): ?Model
    {
        return $this->query->find($id);
    }

    /**
     * Create a new record.
     *
     * @param array $input
     * @return Model
     */
    public function create(array $input): Model
    {
        return $this->model->create($input);
    }

    /**
     * Update a record by ID.
     *
     * @param array $input
     * @param int $id
     * @return Model|null
     */
    public function update(array $input, int $id): ?Model
    {
        $model = $this->find($id);
        if ($model) {
            $model->update($input);
        }
        return $model;
    }

    /**
     * Delete a record by ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $model = $this->find($id);
        if ($model) {
            return $model->delete();
        }
        return false;
    }
}
