<?php

namespace App\Controller\Admin\Module\Banner;

use App\Controller\Admin\AdminController;
use App\Entity\Module\Banner\Teaser;
use App\Form\Type\Module\Banner\TeaserType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

/**
 * TeaserController.
 *
 * Newscast Teaser Action management
 *
 * @author Sébastien FOURNIER <contact@sebastien-fournier.com>
 */
#[IsGranted('ROLE_BANNER')]
#[Route('/admin-%security_token%/{website}/banners/teasers', schemes: '%protocol%')]
class TeaserController extends AdminController
{
    protected ?string $class = Teaser::class;
    protected ?string $formType = TeaserType::class;

    /**
     * Index Teaser.
     */
    #[Route('/index', name: 'admin_bannerteaser_index', methods: 'GET|POST')]
    public function index(Request $request, PaginatorInterface $paginator)
    {
        return parent::index($request, $paginator);
    }

    /**
     * New Teaser.
     */
    #[Route('/new', name: 'admin_bannerteaser_new', methods: 'GET|POST')]
    public function new(Request $request)
    {
        return parent::new($request);
    }

    /**
     * Edit Teaser.
     */
    #[Route('/edit/{bannerteaser}', name: 'admin_bannerteaser_edit', methods: 'GET|POST')]
    public function edit(Request $request)
    {
        return parent::edit($request);
    }

    /**
     * Show Teaser.
     */
    #[Route('/show/{bannerteaser}', name: 'admin_bannerteaser_show', methods: 'GET')]
    public function show(Request $request)
    {
        return parent::show($request);
    }

    /**
     * Position Teaser.
     */
    #[Route('/position/{bannerteaser}', name: 'admin_bannerteaser_position', methods: 'GET|POST')]
    public function position(Request $request)
    {
        return parent::position($request);
    }

    /**
     * Delete Teaser.
     */
    #[Route('/delete/{bannerteaser}', name: 'admin_bannerteaser_delete', methods: 'DELETE')]
    public function delete(Request $request)
    {
        return parent::delete($request);
    }
}
