<?php
declare(strict_types=1);

namespace Core\Model;

use App\Config as conf;
use mysqli;

/**
 * Class DB
 * @package Core\Model
 */
class DB
{
    /**
     * @var mysqli
     */
    private $connection;
    /**
     * @var
     */
    private static $instance;
    /**
     * @var string
     */
    private $host = conf::DB_HOST;
    /**
     * @var string
     */
    private $username = conf::DB_USER;
    /**
     * @var string
     */
    private $password = conf::DB_PASSWORD;
    /**
     * @var string
     */
    private $database = conf::DB_NAME;

    /**
     * @return DB
     */
    public static function getInstance(): DB
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * DB constructor.
     */
    private function __construct()
    {
        $this->connection = new mysqli($this->host, $this->username,
            $this->password, $this->database);

        // Error handling
        if (mysqli_connect_error() && conf::SHOW_ERRORS === true) {
            trigger_error('Failed to connenction to MySQL: '
                . mysqli_connect_error(),
                E_USER_ERROR);
        }
    }

    /**
     *
     */
    private function __clone()
    {
    }

    /**
     * @return mysqli
     */
    public function getConnection(): mysqli
    {
        return $this->connection;
    }

}
