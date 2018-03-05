<?php
declare(strict_types=1);

namespace App\Config;

/**
 * Class Config
 * @package App\Configs
 */
class Glob
{
    /**
     * @return string
     */
    public static function removeSlash(): string
    {
        return trim($_SERVER['QUERY_STRING'], '/');
    }
}
