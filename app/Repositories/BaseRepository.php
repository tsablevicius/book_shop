<?php

namespace App\Repositories;

abstract class BaseRepository
{
    protected $model;

    public function get()
    {
        return $this->model::get();
    }

    public function all()
    {
        return $this->model::all();
    }

    public function find($id)
    {
        return $this->model::find($id)->first();
    }

    public function delete($id)
    {
        return $this->model::destroy($id);
    }

    public function create($data)
    {
        return $this->model::create($data);
    }

    public function update($data, $id): bool
    {
        return $this->model::find($id)->update($data);
    }
}
