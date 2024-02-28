<?php

namespace App\Controller\Front\Action;

use App\Controller\Front\ActionController;
use App\Entity\Module\Banner;
use Symfony\Component\HttpFoundation;
use Symfony\Component\Routing\Attribute\Route;

/**
 * BannerController.
 *
 * Front Banner renders
 *
 * @author Sébastien FOURNIER <contact@sebastien-fournier.com>
 */
class BannerController extends ActionController
{
    /**
     * View.
     */
    public function view(HttpFoundation\Request $request): HttpFoundation\Response
    {
        $website = $this->getWebsite($request);
        $websiteTemplate = $website->getConfiguration()->getTemplate();
        $entity = $this->coreLocator->em()->getRepository(Banner\Banner::class)->findOneOnlineByFilter($request->get('filter'));
        return $this->render('front/'.$websiteTemplate.'/actions/banner/view.html.twig' , [
            'website' => $website,
            'entities' => $entity ? [$entity] : [],
        ]);
    }

    /**
     * Teaser.
     */
    public function teaser(HttpFoundation\Request $request): HttpFoundation\Response
    {
        $website = $this->getWebsite($request);
        $websiteTemplate = $website->getConfiguration()->getTemplate();
        $teaser = $this->coreLocator->em()->getRepository(Banner\Teaser::class)->findOneByFilter($request->get('filter'));
        if (!$teaser) {
            return new HttpFoundation\Response();
        }
        return $this->render('front/'.$websiteTemplate.'/actions/banner/view.html.twig' , [
            'website' => $website,
            'entities' => $this->coreLocator->em()->getRepository(Banner\Banner::class)->findOnlineByTeaser($teaser)
        ]);
    }

    /**
     * Handler.
     */
    #[Route('/banner/handler/{banner}', name: 'front_banner_handler', options: ['isMainRequest' => false], defaults: ['banner' => null], methods: ["POST"], schemes: '%protocol%')]
    public function handler(HttpFoundation\Request $request, ?Banner\Banner $banner = null): HttpFoundation\JsonResponse
    {
        $event = $request->get('event');
        $success = $event && $banner;
        if ($success && $banner->isActive()) {
            if ($event == 'click') {
                $banner->setClickCount($banner->getClickCount() + 1);
            } elseif ($event == 'load') {
                $banner->setViewCount($banner->getViewCount() + 1);
            }
            $this->coreLocator->em()->persist($banner);
            $this->coreLocator->em()->flush();
        }
        return new HttpFoundation\JsonResponse(['success' => $success]);
    }
}