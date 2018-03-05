<?php
declare(strict_types=1);

namespace Core\Server;

use Core\Router\Rest\Rest;

/**
 * Class Response
 * @package Core\Server
 */
abstract class Response implements Rest
{
    protected $request = [];

    public function type()
    {
    }

}
