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
     * @param  array<mixed>  $attributes
     *
     * @return mixed
     */
    public function create(array $attributes): mixed
    {
        return $this->model->create($attributes);
    }

    /**
     * @param  array<mixed>  $attributes
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
     * Get all records with eager loading.
     *
     * @param array<mixed>|string $with
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
     * Find one record with eager loading
     *
     * @param  int  $id
     * @param array<mixed>|string $with
     *
     * @return mixed
     */
    public function findWith(int $id, $with): mixed
    {
        return $this->model->with($with)->find($id);
    }

    /**
     * @param  array<mixed>  $data
     *
     * @return mixed
     */
    public function findBy(array $data): mixed
    {
        return $this->model->where($data)->get();
    }

    /**
     * Get multiple records by condition with eager loading.
     *
     * @param  array<mixed>  $data
     * @param array<mixed>|string $with
     *
     * @return mixed
     */
    public function findWithBy(array $data, $with): mixed
    {
        return $this->model->with($with)->where($data)->get();
    }

    /**
     * @param  array<mixed>  $data
     *
     * @return mixed
     */
    public function findOneBy(array $data): mixed
    {
        return $this->model->where($data)->first();
    }

    /**
     * Find one record by condition with eager loading
     *
     * @param  array<mixed>  $data
     * @param array<mixed>|string $with
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
        $data = $this->model->find($id);
        if ($data){
            return $data->delete();
        }

        return false;

    }

    /**
     * @param  array<mixed>  $data
     *
     * @return bool
     */
    public function deleteBy(array $data): bool
    {
        return $this->model->where($data)->delete();
    }
}
