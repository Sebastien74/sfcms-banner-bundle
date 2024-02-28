<?php

namespace Sfcms\BannerBundle\Controller\Admin;

use App\Controller\Admin\AdminController;
use App\Entity\Module\Banner\Banner;
use App\Form\Type\Module\Banner\BannerType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

/**
 * BannerController.
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
     * Index Banner.
     *
     * {@inheritdoc}
     */
    #[Route('/index', name: 'admin_banner_index', methods: 'GET|POST')]
    public function index(Request $request, PaginatorInterface $paginator)
    {
        return parent::index($request, $paginator);
    }

    /**
     * New Banner.
     *
     * {@inheritdoc}
     */
    #[Route('/new', name: 'admin_banner_new', methods: 'GET|POST')]
    public function new(Request $request)
    {
        return parent::new($request);
    }

    /**
     * Edit Banner.
     *
     * {@inheritdoc}
     */
    #[Route('/edit/{banner}', name: 'admin_banner_edit', methods: 'GET|POST')]
    public function edit(Request $request)
    {
        return parent::edit($request);
    }

    /**
     * Show Banner.
     *
     * {@inheritdoc}
     */
    #[Route('/show/{banner}', name: 'admin_banner_show', methods: 'GET')]
    public function show(Request $request)
    {
        return parent::show($request);
    }

    /**
     * Position Banner.
     *
     * {@inheritdoc}
     */
    #[Route('/position/{banner}', name: 'admin_banner_position', methods: 'GET|POST')]
    public function position(Request $request)
    {
        return parent::position($request);
    }

    /**
     * Delete Banner.
     *
     * {@inheritdoc}
     */
    #[Route('/delete/{banner}', name: 'admin_banner_delete', methods: 'DELETE')]
    public function delete(Request $request)
    {
        return parent::delete($request);
    }
}