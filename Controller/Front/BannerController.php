<?php

namespace App\Controller\Front\Action;
use App\Controller\Front\FrontController;
use Symfony\Component\Routing\Attribute\Route;

/**
 * BannerController.
 *
 * Front Banner renders
 *
 * @author Sébastien FOURNIER <contact@sebastien-fournier.com>
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