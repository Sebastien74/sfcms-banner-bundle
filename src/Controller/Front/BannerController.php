<?php

namespace Sfcms\BannerBundle\Controller\Front;

use App\Controller\Front\FrontController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function toto()
    {
        $website = $this->getWebsite($this->coreLocator->request());
        $websiteTemplate = $website->getConfiguration();
        return $this->render('@SfcmsBanner/front/view.html.twig', [
            'website' => $website,
            'websiteTemplate' => $websiteTemplate
        ]);
    }
}