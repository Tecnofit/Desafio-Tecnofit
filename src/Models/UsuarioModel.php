<?php
namespace Tecnofit\Models;

use Tecnofit\Database\Database;

require_once __DIR__ . "/../../vendor/autoload.php";

class UsuarioModel extends Database
{
    public function teste()
    {
        return $this->findWhere();
    }
}