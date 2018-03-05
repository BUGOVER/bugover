<?php
declare(strict_types=1);

namespace App\Enity;

use Core\CoreModel;
use PDO;

/**
 * Example user model
 *
 * PHP version 7.2
 */
class User extends CoreModel
{

    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public static function getAll(): array
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT id, name FROM users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
