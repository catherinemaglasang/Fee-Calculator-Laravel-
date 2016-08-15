<?php

namespace Thirty98\API\General\Controllers;

use Thirty98\API\General\Entities\ApiResponse;
use Thirty98\API\General\Entities\CategoryRepository;
use Thirty98\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Get list of categories.
     *
     * @param CategoryRepository $categoryRepository
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index(CategoryRepository $categoryRepository)
    {
        return ApiResponse::success('Here are your categories.', $categoryRepository->getCategories());
    }

    /**
     * Get Types for a particular Category.
     *
     * @param $id
     * @param CategoryRepository $categoryRepository
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function getTypes($id, CategoryRepository $categoryRepository)
    {
        return ApiResponse::success(
            'Here are types of this category #' . $id,
            $categoryRepository->getTypesByCategoryId($id)
        );
    }
}

#END OF PHP FILE