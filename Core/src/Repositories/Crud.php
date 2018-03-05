<?php
declare(strict_types=1);

namespace Core\Repositories;

use Core\CoreRepositories;


/**
 * Class Crud
 * @package Core\Repositories
 */
class Crud
{
    protected $repository;

    /**
     * Crud constructor.
     * @param CoreRepositories $CoreRepositories
     */
    public function __construct(CoreRepositories $CoreRepositories)
    {
        $this->repository = $CoreRepositories;
    }

    public function create()
    {

    }

}
