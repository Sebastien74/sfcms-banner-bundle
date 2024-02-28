<?php

namespace App\Controller\Admin\Module\Banner;

use App\Controller\Admin\AdminController;
use App\Entity\Module\Banner\Banner;
use App\Form\Type\Module\Banner\BannerType;
use App\Service\Interface\AdminLocatorInterface;
use App\Service\Interface\CoreLocatorInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

/**
 * BannerController
 *
 * Banner Action management
 *
 * @author Sébastien FOURNIER <contact@sebastien-fournier.com>
 */
#[IsGranted('ROLE_BANNER')]
#[Route('/admin-%security_token%/{website}/banners', schemes: '%protocol%')]
class BannerController extends AdminController
{
    protected ?string $class = Banner::class;
    protected ?string $formType = BannerType::class;

    /**
     * BannerController constructor.
     */
    public function __construct(
        protected CoreLocatorInterface $baseLocator,
        protected AdminLocatorInterface $adminLocator
    ) {
        parent::__construct($baseLocator, $adminLocator);
    }

    /**
     * Index Banner
     */
    #[Route('/index', name: 'admin_banner_index', methods: 'GET|POST')]
    public function index(Request $request, PaginatorInterface $paginator)
    {
        return parent::index($request, $paginator);
    }

    /**
     * New Banner
     */
    #[Route('/new', name: 'admin_banner_new', methods: 'GET|POST')]
    public function new(Request $request)
    {
        return parent::new($request);
    }

    /**
     * Edit Banner
     */
    #[Route('/edit/{banner}', name: 'admin_banner_edit', methods: 'GET|POST')]
    public function edit(Request $request)
    {
        return parent::edit($request);
    }

    /**
     * Delete Banner
     */
    #[Route('/delete/{banner}', name: 'admin_banner_delete', methods: 'DELETE')]
    public function delete(Request $request)
    {
        return parent::delete($request);
    }
}