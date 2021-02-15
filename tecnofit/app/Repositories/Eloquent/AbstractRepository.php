<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\AbstractRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class AbstractRepository implements AbstractRepositoryInterface
{
    /**
     * Instance that extends Illuminate\Database\Eloquent\Model
     *
     * @var Model
     */
    protected $model;

    /**
     *  A limit for paginate
     *
     * @var $limit
     */
    protected $limit = 15;

    /**
     * Constructor
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get Model instance
     *
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Get class name
     *
     * @param Model $model
     */
    protected function getClassName()
    {
        return class_basename($this->model);
    }

    /**
     * Get all from resource
     *
     * @return Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Find a resource by id
     *
     * @param $id
     * @return Model|null
     */
    public function find(int $id)
    {
        $response =  $this->model->find($id);
        if (empty($response)) {
            return;
        }

        return $response;
    }

    /**
     * Find a resource by criteria
     *
     * @param array $criteria
     * @return Model|null
     */
    public function findOneBy(array $criteria)
    {
        return $this->model->where($criteria)->first();
    }

    /**
     * Search All resources by any values of a key
     *
     * @param string $key
     * @param array $values
     * @return Collection
     */
    public function findIn(string $key, array $values)
    {
        return $this->model->whereIn($key, $values)->get();
    }

    /**
     * Search All resources by criteria
     *
     * @param array $searchCriteria
     * @return Collection
     */
    public function findBy(array $searchCriteria = [])
    {
        $queryBuilder = $this->model->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });
        return $queryBuilder->get();
    }

    /**
     * Apply condition on query builder based on search criteria
     *
     * @param Object $queryBuilder
     * @param array $searchCriteria
     * @return mixed
     */
    protected function applySearchCriteriaInQueryBuilder($queryBuilder, array $searchCriteria = [])
    {
        foreach ($searchCriteria as $key => $value) {
            $queryBuilder->where($key, $value);
        }
        return $queryBuilder;
    }

    /**
     * Save a resource
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data)
    {
        $filledProperties = $this->model->getFillable();
        $keys = array_keys($data);
        foreach ($keys as $key) {
            if (!in_array($key, $filledProperties)) {
                unset($data[$key]);
            }
        }

        return $this->model->create($data);
    }

    /**
     * Update a resource
     *
     * @param integer $id
     * @param array $data
     * @return Model
     */
    public function update(int $id, array $data)
    {
        $model = $this->find($id);
        $filledProperties = $model->getFillable();
        $keys = array_keys($data);
        foreach ($keys as $key) {
            if (in_array($key, $filledProperties)) {
                $model->$key = $data[$key];
            }
        }
        $model->save($data);
        return $model;
    }

    /**
     * Delete a resource
     *
     * @param Model $model
     * @return boolean
     */
    public function delete($model)
    {
        return $model->delete();
    }
}
