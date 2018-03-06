<?php
declare(strict_types=1);

namespace App\Controllers;

use Core\CoreController;
use Core\View\View;

/**
 * home controller
 *
 * PHP version 7.2
 */
class HomeController extends CoreController
{

    /**
     * Show the index page
     *
     * @return void
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function indexAction(): void
    {
        View::get('pages/home/index');
    }
}
