<?php

namespace App\Controller\Front\Action;

use App\Controller\Front\FrontController;
use Symfony\Component\Routing\Attribute\Route;

/**
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
    public function view()
    {
        $website = $this->getWebsite($this->coreLocator->request());
        $websiteTemplate = $website->getConfiguration();
        return $this->render('front/'.$websiteTemplate.'/actions/banner/view.html.twig', [
            'website' => $website,
            'websiteTemplate' => $websiteTemplate
        ]);
    }
}