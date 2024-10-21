<?php

namespace App\Repositories;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategories() {
        return Category::all();
    }

    public function getCategoryById($id) {
        return Category::find($id);
    }

    public function createCategory(array $data) {
        return Category::create($data);
    }

    public function updateCategory($id, array $data) {
        return Category::where('id', $id)->update($data);
    }

    public function deleteCategory($id) {
        return Category::destroy($id);
    }
}
