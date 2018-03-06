<?php
declare(strict_types=1);

/**
 * @param $data
 */
function dd($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    die();
}

/**
 * @param $data
 */
function dump($data)
{
    echo '<pre>';
    /** @noinspection ForgottenDebugOutputInspection */
    var_dump($data);
    echo '</pre>';
    die();
}
