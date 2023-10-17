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
     * Get all records with eager loading.
     *
     * @param array<mixed>|string $with
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
     * Find one record by condition with eager loading
     *
     * @param  array<mixed>  $data
     * @param array<mixed>|string $with
     *
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
     * Find one record with eager loading
     *
     * @param  int  $id
     * @param array<mixed>|string $with
     *
     * @return mixed
     */
    public function findWith(int $id, $with): mixed;

    /**
     * Get multiple records by condition with eager loading.
     *
     * @param  array<mixed>  $data
     * @param array<mixed>|string $with
     *
     * @return mixed
     */
    public function findWithBy(array $data, $with): mixed;
}
