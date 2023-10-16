<?php

namespace App\Repositories\Contracts;

interface BaseRepositoryInterface
{
    /**
     * @param array<mixed> $attributes
     * @return mixed
     */
    public function create(array $attributes): mixed;

    /**
     * @param array<mixed> $attributes
     * @param int $id
     * @return bool
     */
    public function update(array $attributes, int $id): bool;

    /**
     * @return mixed
     */
    public function getAll(): mixed;

    /**
     * @param $with
     * @return mixed
     */
    public function getAllWith($with): mixed;

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id): mixed;

    /**
     * @param array<mixed> $data
     * @return mixed
     */
    public function findBy(array $data): mixed;

    /**
     * @param array<mixed> $data
     * @return mixed
     */
    public function findOneBy(array $data): mixed;

    /**
     * @param array<mixed> $data
     * @param $with
     * @return mixed
     */
    public function findOneWithBy(array $data, $with): mixed;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * @param array<mixed> $data
     * @return bool
     */
    public function deleteBy(array $data): bool;

    /**
     * @param int $id
     * @param $with
     * @return mixed
     */
    public function findWith(int $id, $with): mixed;

    /**
     * @param array<mixed> $data
     * @param $with
     * @return mixed
     */
    public function findWithBy(array $data, $with): mixed;
}
