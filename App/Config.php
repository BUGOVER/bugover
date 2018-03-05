<?php
declare(strict_types=1);

namespace App;

/**
 * Application configuration
 *
 * PHP version 7.2
 */
class Config
{

    /**
     * Database host
     * @var string
     */
    public const DB_HOST = '127.0.0.1';

    /**
     * Database name
     * @var string
     */
    public const DB_NAME = 'dev';

    /**
     * Database user
     * @var string
     */
    public const DB_USER = 'root';

    /**
     * Database password
     * @var string
     */
    public const DB_PASSWORD = '';

    /**
     * Show or hide error messages on screen
     * @var boolean
     */
    public const SHOW_ERRORS = true;
}
