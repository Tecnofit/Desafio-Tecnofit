<?php
namespace Tecno\Exception;

class InvalidRouteException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Invalid route! Please check the route.php file');
    }
}