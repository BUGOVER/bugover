<?php
declare(strict_types=1);

namespace Core\View;

use const ROOT;

/**
 * View
 *
 * PHP version 7.2
 */
class View
{
    use ViewTrat;

    /**
     * Render a view file
     *
     * @param string $view The view file
     * @param array $args Associative array of data to display in the view (optional)
     *
     * @return void
     * @throws \Exception
     */
    public static function render(string $view, array $args = []): void
    {
        extract($args, EXTR_SKIP);

        $file = ROOT . "/resources/views/$view";  // relative to Core directory

        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }

    /**
     * Render a view template using Twig
     *
     * @param string $template The template file
     * @param array $args Associative array of data to display in the view (optional)
     *
     * @return void
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public static function get(string $template, array $args = []): void
    {
        static $twig = null;

        if ($twig === null) {
            $loader = new \Twig_Loader_Filesystem(ROOT . '/resources/views');
            $twig = new \Twig_Environment($loader/*, [
                'cache' => ROOT . 'resources/storage'
            ]*/);
        }

        echo $twig->render($template . '.html.twig', $args);
    }
}
