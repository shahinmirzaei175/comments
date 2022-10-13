<?php


namespace App\Repositories\Base;

use App\Repositories\Interfaces\CrudRepositoryInterface;

abstract class CrudRepository implements CrudRepositoryInterface
{
    abstract protected function model();

    public function get()
    {
        return $this->model()->get();
    }

    public function find($id)
    {
        return $this->model()->find($id);
    }

    public function store(array $data)
    {
        return $this->model()->create($data);
    }

    public function update($id, array $data)
    {
        $this->model()->where('id',$id)->update($data);
        return $this->find($id);
    }

    public function delete($id)
    {
        return $this->model()->where('id',$id)->delete();
    }
}
