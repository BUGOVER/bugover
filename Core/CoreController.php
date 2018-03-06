<?php
declare(strict_types=1);

namespace Core;

/**
 * Base controller
 *
 * PHP version 7.2
 */
abstract class CoreController
{
    /**
     * Magic method called when a non-existent or inaccessible method is
     * called on an object of this class. Used to execute before and after
     * filter methods on action methods. Action methods need to be named
     * with an "Action" suffix, e.g. indexAction, showAction etc.
     *
     * @param string $name Method name
     * @param array $args Arguments passed to the method
     *
     * @return void
     * @throws \Exception
     */
    public function __call(string $name, $args)
    {
        $method = $name . 'Action';

        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                \call_user_func_array([$this, $method], $args);
                $this->after();
            }
        } else {
            throw new \RuntimeException("Method $method not found in controller " . \get_class($this));
        }
    }

    /**
     * Before filter - called before an action method.
     *
     * @return void
     */
    protected function before(): void
    {
    }

    /**
     * After filter - called after an action method.
     *
     * @return void
     */
    protected function after(): void
    {
    }
}
