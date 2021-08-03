<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getAll()
    {
        return $this->model->orderBy('created_at', 'DESC')->get();
    }

    public function paginate($limit)
    {
        return $this->model->orderBy('created_at', 'DESC')->paginate($limit);
    }

    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();
            return true;
        }

        return false;
    }

    public function findBy($attribute, $value, $limit)
    {
        return $this->model->where($attribute, '=', $value)->paginate($limit);
    }

    public function where($attribute, $value)
    {
        return $this->model->where($attribute, '=', $value)->first();
    }
}