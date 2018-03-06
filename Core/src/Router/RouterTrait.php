<?php
declare(strict_types=1);

namespace Core\Router;


/**
 * Trait RouterTrait
 * @package Core\Src
 */
/**
 * Trait RouterTrait
 * @package Core\Router
 */
trait RouterTrait
{
    /**
     * @var int
     */
    protected $maxScanDepth = 3;

    /**
     * @var
     */
    protected $route;

    /**
     * @param $dir
     * @param int $depth Todo
     */
    protected function _require_all(string $dir, int $depth = 0): void
    {
        $dir .= 'App/Config/';
        if ($depth > $this->maxScanDepth) {
            return;
        }
        // require all php files
        $scan = glob("$dir/*");
        foreach ($scan as $path) {
            if (preg_match('/\.php$/', $path)) {
                require_once $path;
            } elseif (is_dir($path)) {
                $this->_require_all($path, $depth + 1);
            }
        }
    }


    /**
     * Convert the string with hyphens to StudlyCaps,
     * e.g. post-authors => PostAuthors
     *
     * @param string $string The string to convert
     *
     * @return string
     */
    protected function convertToStudlyCaps(string $string): string
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    /**
     * Convert the string with hyphens to camelCase,
     * e.g. add-new => addNew
     *
     * @param string $string The string to convert
     *
     * @return string
     */
    protected function convertToCamelCase(string $string): string
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }

    /**
     *   URL                           $_SERVER['QUERY_STRING']  Route
     *   -------------------------------------------------------------------
     *   localhost                     ''                        ''
     *   localhost/?                   ''                        ''
     *   localhost/?page=1             page=1                    ''
     *   localhost/posts?page=1        posts&page=1              posts
     *   localhost/posts/index         posts/index               posts/index
     *   localhost/posts/index?page=1  posts/index&page=1        posts/index
     *
     * @param string $url The full URL
     *
     * @return string The URL with the query string variables removed
     */
    protected function removeQueryStringVariables(string $url): string
    {
        if ($url !== '') {

            $parts = explode('&', $url, 2);

            if (strpos($parts[0], '=')) {
                $url = '';
            } else {
                $url = $parts[0];
            }

        }

        return $url;
    }

    /**
     * @param string $route
     *
     * @return string
     */
    public function routeRegex(string $route): string
    {
        // Convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);

        // Convert variables e.g. {controller}
        $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

        // Convert variables with custom regular expressions e.g. {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        // Add start and end delimiters, and case insensitive flag
        $route = '/^' . $route . '$/i';

        return $this->route = $route;
    }

}
