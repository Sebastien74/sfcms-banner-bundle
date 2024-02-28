<?php

namespace App\Controller\Admin\Module\Banner;

use App\Controller\Admin\AdminController;
use App\Entity\Module\Banner\Category;
use App\Form\Type\Module\Banner\CategoryType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

/**
 * CategoryController
 *
 * Banner Category Action management
 *
 * @author Sébastien FOURNIER <contact@sebastien-fournier.com>
 */
#[IsGranted('ROLE_BANNER')]
#[Route('/admin-%security_token%/{website}/banners/categories', schemes: '%protocol%')]
class CategoryController extends AdminController
{
    protected ?string $class = Category::class;
    protected ?string $formType = CategoryType::class;

    /**
     * Index Category.
     */
    #[Route('/index', name: 'admin_bannercategory_index', methods: 'GET|POST')]
    public function index(Request $request, PaginatorInterface $paginator)
    {
        return parent::index($request, $paginator);
    }

    /**
     * New Category.
     */
    #[Route('/new', name: 'admin_bannercategory_new', methods: 'GET|POST')]
    public function new(Request $request)
    {
        return parent::new($request);
    }

    /**
     * Edit Category.
     */
    #[Route('/edit/{bannercategory}', name: 'admin_bannercategory_layout', methods: 'GET|POST')]
    public function edit(Request $request)
    {
        return parent::layout($request);
    }

    /**
     * Show Category.
     */
    #[Route('/show/{bannercategory}', name: 'admin_bannercategory_show', methods: 'GET')]
    public function show(Request $request)
    {
        return parent::show($request);
    }

    /**
     * Position Category.
     */
    #[Route('/position/{bannercategory}', name: 'admin_bannercategory_position', methods: 'GET|POST')]
    public function position(Request $request)
    {
        return parent::position($request);
    }

    /**
     * Delete Category.
     */
    #[Route('/delete/{bannercategory}', name: 'admin_bannercategory_delete', methods: 'DELETE')]
    public function delete(Request $request)
    {
        return parent::delete($request);
    }
}