<?php

namespace App\Controller\Admin\Module\Admin;

use App\Controller\Admin\AdminController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

/**
 * BannerController.
 *
 * @author Sébastien FOURNIER <contact@sebastien-fournier.com>
 */
#[IsGranted('ROLE_BANNER')]
#[Route('/admin-%security_token%/{website}/agendas', schemes: '%protocol%')]
class BannerController extends AdminController
{

}