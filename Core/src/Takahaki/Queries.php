<?php
declare(strict_types=1);

namespace Core\Takahaki;

/**
 * Interface Queries
 * @package Core\Src\Takahaki
 */
/**
 * Interface Queries
 * @package Core\Src\Takahaki
 */
interface Queries
{
    /**
     * @return mixed
     */
    public function execute();

    /**
     * @return mixed
     */
    public function query();

    /**
     * @return mixed
     */
    public function select();

    /**
     * @return mixed
     */
    public function update();

    /**
     * @return mixed
     */
    public function edit();

    /**
     * @return mixed
     */
    public function delete();

}
