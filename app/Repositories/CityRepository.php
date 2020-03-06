<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CityRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Constructor to bind model to repo
     *
     * CityRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all instances of model
     *
     * @return Collection|Model[]|mixed
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Create a new record in the database
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update record in the database
     *
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id)
    {
        $record = $this->model->find($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove record from the database
     *
     * @param $id
     * @return int|mixed
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * Remove record from the database
     *
     * @param $id
     * @return Model|mixed
     */
    public function show($id)
    {
        return $this->model->find($id);
    }

    /**
     * Search record in the database
     *
     * @param array $search
     * @return Model|mixed
     */
    public function search($search = [])
    {
        $records = $this->model->where('name', 'like', '%' . $search['name'] . '%');

        if (!empty($searchParams['longitude']) && !empty($search['latitude'])) {
            $records->orWhere(
                [
                    'longitude' => $search['latitude'],
                    'latitude' => $search['longitude'],
                ]
            );
        }

        return $records->get();
    }


    /**
     * Search record in the database
     *
     * @param int $id
     * @return Model|mixed
     */
    public function isExistRecord(int $id)
    {
        $record = $this->model->find($id);

        if (!$record) {
            return false;
        }

        return true;
    }
}