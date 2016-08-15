<?php

namespace Thirty98\API\General\Entities;

use Thirty98\API\General\Models\Category;

class CategoryRepository
{
    /**
     * Get list of categories.
     *
     * @return mixed
     */
    public function getCategories()
    {
        return Category::orderBy('name', 'asc')->get();
    }

    /**
     * Get Types by Category ID.
     *
     * @param int $id
     * @return array
     */
    public function getTypesByCategoryId($id = 0)
    {
        $category = Category::find($id);

        if (!$category) {
            return [];
        }

        return $category->types;
    }
}
#END OF PHP FILE