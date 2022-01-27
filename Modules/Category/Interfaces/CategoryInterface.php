<?php

namespace Modules\Category\Interfaces;

interface CategoryInterface
{
    public function allCategory();
    public function createCategory(array $categoryData);
    public function editCategory($categoryId);
    public function updateCategory(array $categoryData,$categoryId);
    public function deleteCategory($categoryId);
}
