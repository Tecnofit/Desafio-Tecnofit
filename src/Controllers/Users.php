<?php
namespace Tecnofit\Controllers;

use Tecnofit\Models\UserModel;

class Users extends UserModel
{
    public function index()
    {
        return $this->getAllUsers();
    }
}