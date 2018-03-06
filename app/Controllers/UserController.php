<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\CoreController;
use Core\View\View;

/**
 * Class UserController
 * @package App\Controllers
 */
class UserController extends CoreController
{
    public function __construct()
    {

    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function indexAction(): void
    {
        $data = ['page' => 'USER'];

        View::get('pages/user/index',
            ['data' => $data]);
    }

}
