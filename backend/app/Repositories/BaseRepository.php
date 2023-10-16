<?php

namespace App\Repositories;

use App\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    /**
     * BaseRepository constructor.
     *
     * @param  Model  $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param  array  $attributes
     *
     * @return mixed
     */
    public function create(array $attributes): mixed
    {
        return $this->model->create($attributes);
    }

    /**
     * @param  array  $attributes
     * @param  int  $id
     *
     * @return bool
     */
    public function update(array $attributes, int $id): bool
    {
        return $this->find($id)->update($attributes);
    }

    /**
     * @return mixed
     */
    public function getAll(): mixed
    {
        return $this->model->latest()->get();
    }

    /**
     * @param $with
     *
     * @return mixed
     */
    public function getAllWith($with): mixed
    {
        return $this->model->with($with)->latest()->get();
    }

    /**
     * @param  int  $id
     *
     * @return mixed
     */
    public function find(int $id): mixed
    {
        return $this->model->find($id);
    }

    /**
     * @param  int  $id
     * @param $with
     *
     * @return mixed
     */
    public function findWith(int $id, $with): mixed
    {
        return $this->model->with($with)->find($id);
    }

    /**
     * @param  array  $data
     *
     * @return mixed
     */
    public function findBy(array $data): mixed
    {
        return $this->model->where($data)->get();
    }

    /**
     * @param  array  $data
     * @param $with
     *
     * @return mixed
     */
    public function findWithBy(array $data, $with): mixed
    {
        return $this->model->with($with)->where($data)->get();
    }

    /**
     * @param  array  $data
     *
     * @return mixed
     */
    public function findOneBy(array $data): mixed
    {
        return $this->model->where($data)->first();
    }

    /**
     * @param  array  $data
     *
     * @return mixed
     */
    public function findOneWithBy(array $data, $with): mixed
    {
        return $this->model->with($with)->where($data, $with)->first();
    }

    /**
     * @param  int  $id
     *
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->model->find($id)->delete();
    }

    /**
     * @param  array  $data
     *
     * @return bool
     */
    public function deleteBy(array $data): bool
    {
        return $this->model->where($data)->delete();
    }
}
