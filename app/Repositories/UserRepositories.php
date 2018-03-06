<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Enity\User;
use Core\CoreRepositories;


/**
 * Class UserRepositories
 * @package App\Repositories
 */
class UserRepositories extends CoreRepositories
{
    protected $user;

    /**
     * UserRepositories constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

}
