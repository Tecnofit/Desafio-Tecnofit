<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface extends AbstractRepositoryInterface
{
    public function getAllCustomers();
}
