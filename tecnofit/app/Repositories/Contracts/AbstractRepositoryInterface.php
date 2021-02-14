<?php

namespace App\Repositories\Contracts;

interface AbstractRepositoryInterface
{
    public function all();
    public function find(int $id);
    public function findOneBy(array $criteria);
    public function findBy(array $criteria = []);
    public function findIn(string $key, array $criteria);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete($model);
}
