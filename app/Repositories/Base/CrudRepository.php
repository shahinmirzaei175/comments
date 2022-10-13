<?php

namespace App\Repositories\Base;

use App\Repositories\Interfaces\CrudRepositoryInterface;

abstract class CrudRepository implements CrudRepositoryInterface
{
    /**
     * Set model object.
     *
     * @return mixed
     */
    abstract protected function model();

    /**
     * Get list.
     *
     * @return mixed
     */
    public function get()
    {
        return $this->model()->get();
    }

    /**
     * Find model.
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model()->find($id);
    }

    /**
     * Store model.
     *
     * @param array $data
     * @return mixed
     */
    public function store(array $data)
    {
        return $this->model()->create($data);
    }

    /**
     * Update model.
     *
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        $this->model()->where('id', $id)->update($data);

        return $this->find($id);
    }

    /**
     * Delete model.
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model()->where('id', $id)->delete();
    }
}
