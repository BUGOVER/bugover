<?php
declare(strict_types=1);

namespace Core\Router\Rest;

use Core\Router\Rest\Type\RouterDelete;
use Core\Router\Rest\Type\RouterGet;
use Core\Router\Rest\Type\RouterHead;
use Core\Router\Rest\Type\RouterOption;
use Core\Router\Rest\Type\RouterPost;
use Core\Router\Rest\Type\RouterPut;
use Core\Router\RouterTrait;

/**
 * Class RouterMatch
 * @package Core\Router
 */
abstract class RouterMatch
{
    use RouterTrait;

    /**
     * Add a route to the routing table
     *
     * @param string $route The route URL
     * @param array $params Parameters (controller, action, etc.)
     *
     * @return void
     */
    public function match(string $route, array $params = []): void
    {
        $routes = $this->routeRegex($route);

        $this->routesMatch[$routes] = $params;
    }

    /**
     * Add a route to the routing table
     *
     * @param string $route The route URL
     * @param array $params Parameters (controller, action, etc.)
     *
     * @return void
     */
    public function get(string $route, array $params = []): void
    {
        $routes = $this->routeRegex($route);


        $this->routesGet[$routes] = $params;

        new RouterGet($this->routesGet);
    }

    /**
     * Add a route to the routing table
     *
     * @param string $route The route URL
     * @param array $params Parameters (controller, action, etc.)
     *
     * @return void
     */
    public function post(string $route, array $params = []): void
    {
        $routes = $this->routeRegex($route);


        $this->routesPost[$routes] = $params;

        new RouterPost($this->routesPost);
    }

    /**
     * Add a route to the routing table
     *
     * @param string $route The route URL
     * @param array $params Parameters (controller, action, etc.)
     *
     * @return void
     */
    public function put(string $route, array $params = []): void
    {
        $routes = $this->routeRegex($route);

        $this->routesPut[$routes] = $params;

        $put = new RouterPut($this->routesPut);
    }

    /**
     * Add a route to the routing table
     *
     * @param string $route The route URL
     * @param array $params Parameters (controller, action, etc.)
     *
     * @return void
     */
    public function delete(string $route, array $params = []): void
    {
        $routes = $this->routeRegex($route);


        $this->routesDelete[$routes] = $params;

        $delete = new RouterDelete($this->routesDelete);
    }

    /**
     * Add a route to the routing table
     *
     * @param string $route The route URL
     * @param array $params Parameters (controller, action, etc.)
     *
     * @return void
     */
    public function head(string $route, array $params = []): void
    {
        $routes = $this->routeRegex($route);


        $this->routesHead[$routes] = $params;

        $head = new RouterHead($this->routesHead);
    }

    /**
     * Add a route to the routing table
     *
     * @param string $route The route URL
     * @param array $params Parameters (controller, action, etc.)
     *
     * @return void
     */
    public function option(string $route, array $params = []): void
    {
        $routes = $this->routeRegex($route);


        $this->routesOption[$routes] = $params;

        $option = new RouterOption($this->routesOption);
    }
}
