<?php
declare(strict_types=1);

namespace Core\Server;

use Core\Router\Rest\Rest;
use Core\Router\Rest\Type\Headers;

/**
 * Class Requests
 * @package Core\Request
 */
abstract class Requests extends Headers implements Rest
{

    protected $server = [];

    public function getType()
    {
    }


}
