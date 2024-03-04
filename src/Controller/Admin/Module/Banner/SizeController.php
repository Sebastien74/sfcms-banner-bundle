<?php

namespace App\Controller\Admin\Module\Banner;

use App\Controller\Admin\AdminController;
use App\Entity\Module\Banner\Size;
use App\Form\Type\Module\Banner\SizeType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

/**
 * SizeController
 *
 * Banner Size Action management
 *
 * @author Sébastien FOURNIER <contact@sebastien-fournier.com>
 */
#[IsGranted('ROLE_BANNER')]
#[Route('/admin-%security_token%/{website}/banners/categories', schemes: '%protocol%')]
class SizeController extends AdminController
{
    protected ?string $class = Size::class;
    protected ?string $formType = SizeType::class;

    /**
     * Index Size.
     */
    #[Route('/index', name: 'admin_bannersize_index', methods: 'GET|POST')]
    public function index(Request $request, PaginatorInterface $paginator)
    {
        return parent::index($request, $paginator);
    }

    /**
     * New Size.
     */
    #[Route('/new', name: 'admin_bannersize_new', methods: 'GET|POST')]
    public function new(Request $request)
    {
        return parent::new($request);
    }

    /**
     * Edit Size.
     */
    #[Route('/edit/{bannersize}', name: 'admin_bannersize_layout', methods: 'GET|POST')]
    public function edit(Request $request)
    {
        return parent::layout($request);
    }

    /**
     * Show Size.
     */
    #[Route('/show/{bannersize}', name: 'admin_bannersize_show', methods: 'GET')]
    public function show(Request $request)
    {
        return parent::show($request);
    }

    /**
     * Position Size.
     */
    #[Route('/position/{bannersize}', name: 'admin_bannersize_position', methods: 'GET|POST')]
    public function position(Request $request)
    {
        return parent::position($request);
    }

    /**
     * Delete Size.
     */
    #[Route('/delete/{bannersize}', name: 'admin_bannersize_delete', methods: 'DELETE')]
    public function delete(Request $request)
    {
        return parent::delete($request);
    }
}