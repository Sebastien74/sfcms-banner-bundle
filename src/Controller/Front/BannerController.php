<?php

namespace SFCms\BannerBundle\src\Controller\Front;

use App\Controller\Front\FrontController;
use Symfony\Component\Routing\Attribute\Route;

/*
 * BannerController.
 *
 * (c) Sébastien FOURNIER <contact@sebastien-fournier.com>
 *
 * Front Banner renders
 */
class BannerController extends FrontController
{
    /**
     * Index.
     */
    #[Route('/action/banner/view', name: 'front_banner_view', options: ['isMainRequest' => false], methods: 'GET', schemes: '%protocol%')]
    public function index()
    {
        die;
    }
}