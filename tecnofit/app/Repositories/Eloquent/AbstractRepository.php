<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\CustomException;
use App\Repositories\Contracts\AbstractRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AbstractRepository implements AbstractRepositoryInterface
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
        //Apply all conditions depends on criteria
        $queryBuilder = $this->model->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });

        //Order by criteria, eg: order by name desc
        if (!empty($searchCriteria['order_by']) && !empty($searchCriteria['sorted_by'])) {
            $queryBuilder->orderBy($searchCriteria['order_by'], $searchCriteria['sorted_by']);
        }

        //Filter by date range
        $this->applyFilterByIntervalDates($queryBuilder, $searchCriteria);

        //Set Limit Pagination
        $limit = !empty($searchCriteria['per_page']) ? (int) $searchCriteria['per_page'] : $this->limit;

        //Return a query with paginate
        return $queryBuilder->paginate($limit);
    }

    /**
     * Apply condition on query builder based on search criteria
     *
     * @param Object $query
     * @param array $data
     * @param string $field
     * @return mixed
     */
    public function applyFilterByIntervalDates($query, $data, $field = 'created_at')
    {
        if (isset($data['date_start'])) {
            $date_end = isset($data['date_end']) ? $data['date_end'] : date('Y-m-d');
            $query->where(DB::raw("(DATE_FORMAT($field,'%Y-%m-%d'))"), '>=', $data['date_start']);
            $query->where(DB::raw("(DATE_FORMAT($field,'%Y-%m-%d'))"), '<=', $date_end);
        }
        return $query;
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
        //Allowed Fields
        $allowed = ['page', 'per_page', 'order_by', 'sorted_by', 'with', 'where', 'date_start', 'date_end'];

        foreach ($searchCriteria as $key => $value) {

            //skip pagination related query params
            if (in_array($key, $allowed) || empty($value)) {
                continue;
            }

            //we can pass multiple params for a searchCriteria with commas
            $allValues = explode(',', $value);

            if (count($allValues) > 1) {
                $queryBuilder->whereIn($key, $allValues);
            } else {
                $operator = ($value[0] == '%' || substr($value, -1) == '%') ? 'like' : '=';
                $join = explode('/', $key);
                if (isset($join[1])) {
                    if (isset($searchCriteria['where']) && strtoupper($searchCriteria['where']) == 'AND') {
                        $queryBuilder->whereHas($join[0], function ($query) use ($join, $operator, $value) {
                            $query->where($join[1], $operator, $value);
                        });
                    } else {
                        $queryBuilder->orWhereHas($join[0], function ($query) use ($join, $operator, $value) {
                            $query->where($join[1], $operator, $value);
                        });
                    }
                } else {
                    if (isset($searchCriteria['where']) && strtoupper($searchCriteria['where']) == 'OR') {
                        $queryBuilder->orWhere($key, $operator, $value);
                    } else {
                        $queryBuilder->where($key, $operator, $value);
                    }
                }
            }
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
