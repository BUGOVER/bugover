<?php
declare(strict_types=1);

namespace Core\Exceptions;

use Core\View\View;
use Exception;

/**
 * Error and exception handler
 *
 * PHP version 7.2
 */
class Error extends Exception
{

    /**
     * Error handler. Convert all errors to Exceptions by throwing an ErrorException.
     *
     * @param int $level Error level
     * @param string $message Error message
     * @param string $file Filename the error was raised in
     * @param int $line Line number in the file
     *
     * @return void
     * @throws \ErrorException
     */
    public static function errorHandler($level, $message, $file, $line): void
    {
        if (error_reporting() !== 0) {  // to keep the @ operator working
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }

    /**
     * Exception handler.
     *
     * @param Exception $exception The exception
     *
     * @return void
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public static function exceptionHandler($exception): void
    {
        // Code is 404 (not found) or 500 (general error)
        $code = $exception->getCode();
        if ($code !== 404) {
            $code = 500;
        }
        http_response_code($code);

        if (\App\Config::SHOW_ERRORS) {
            echo '<h1>Fatal error</h1>';
            echo "<p>Uncaught exception: '" . get_class($exception) . "'</p>";
            echo "<p>Message: '" . $exception->getMessage() . "'</p>";
            echo '<p>Stack trace:<pre>' . $exception->getTraceAsString() . '</pre></p>';
            echo "<p>Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine() . '</p>';
        } else {
            $log = ROOT . '/logs/' . date('Y-m-d') . '.txt';
            ini_set('error_log', $log);

            $message = "Uncaught exception: '" . \get_class($exception) . "'";
            $message .= " with message '" . $exception->getMessage() . "'";
            $message .= "\nStack trace: " . $exception->getTraceAsString();
            $message .= "\nThrown in '" . $exception->getFile() . "' on line " . $exception->getLine();

            /** @noinspection ForgottenDebugOutputInspection */
            error_log($message);

            View::get("$code.html.twig");
        }
    }

    /**
     * @param $controller
     * @throws \RuntimeException
     */
    public static function emptyController($controller)
    {
        throw new \RuntimeException("CoreController class $controller not found");
    }

    /**
     * @param $controller
     * @throws \RuntimeException
     * @throws Exception
     */
    public static function emptyControllerAction($action, $controllerObject)
    {
        throw new \RuntimeException("Method $action in controller $controllerObject cannot be
                 called directly - remove the Action suffix to call this method");
    }

}
