<?php
declare(strict_types=1);

namespace Core\Router;

use App\Config\Glob;
use Core\CoreController;
use Core\Exceptions\Error;
use Core\Router\Rest\RouterMatch;

/**
 * Router
 *
 * PHP version 7.2
 */
class Router extends RouterMatch
{
    /**
     * Associative array of routes (the routing table)
     * @var array
     */
    protected $routesMatch = [];
    /**
     * @var array
     */
    protected $routesGet = [];
    /**
     * @var array
     */
    protected $routesPost = [];
    /**
     * @var array
     */
    protected $routesPut = [];
    /**
     * @var array
     */
    protected $routesDelete = [];
    /**
     * @var array
     */
    protected $routesHead = [];
    /**
     * @var array
     */
    protected $routesOption = [];

    /**
     * Parameters from the matched route
     * @var array
     */
    protected $params = [];

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->_require_all(ROOT);
    }

    /**
     * Get all the routes from the routing table
     *
     * @return array
     */
    public function getRoutesMatch(): array
    {
        return $this->routesMatch;
    }

    /**
     * Match the route to the routes in the routing table, setting the $params
     * property if a route is found.
     *
     * @param string $url The route URL
     *
     * @return boolean  true if a match found, false otherwise
     */
    private function urlMatch(string $url): bool
    {
        foreach ($this->routesMatch as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                // Get named capture group values
                foreach ($matches as $key => $match) {
                    if (\is_string($key)) {
                        $params[$key] = $match;
                    }
                }

                $this->params = $params;

                return true;
            }
        }

        return false;
    }

    /**
     * Get the currently matched parameters
     *
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * Dispatch the route, creating the controller object and running the
     * action method
     *
     * @return Router
     * @throws \Exception
     */
    public function run(): Router
    {
        $url = $this->removeQueryStringVariables(Glob::removeSlash());

        if ($this->urlMatch($url)) {

            $controller = $this->params['controller'] . 'Controller';
            $controller = $this->convertToStudlyCaps($controller);
            $controller = $this->getNamespace() . $controller;

            /**
             * -> is isset Controller
             */
            $this->controllerExists($controller);

            return $this;
        }

        throw new \RuntimeException('No route matched.', 404);
    }

    /**
     * @param $controller
     *
     * @throws \Exception
     */
    private function controllerExists(string $controller): void
    {
        if (class_exists($controller)) {
            $controllerObject = new $controller($this->params);

            $action = $this->params['action'];
            $action = $this->convertToCamelCase($action);

            $this->getControllerAction($controllerObject, $action);

        } else {
            Error::emptyController($controller);
        }
    }

    /**
     * @param $controllerObject
     * @param $action
     *
     * @throws \Exception
     */
    private function getControllerAction(CoreController $controllerObject, string $action): void
    {
        if (preg_match('/^action$/i', $action) === 0) {
            $controllerObject->$action();

        } else {
            Error::emptyControllerAction($action, $controllerObject);
        }
    }

    /**
     * Get the namespace for the controller class. The namespace defined in the
     * route parameters is added if present.
     *
     * @return string The request URL
     */
    private function getNamespace(): string
    {
        $namespace = 'App\Controllers\\';

        if (array_key_exists('namespace', $this->params)) {
            $namespace .= $this->params['namespace'] . '\\';
        }

        return $namespace;
    }

}
