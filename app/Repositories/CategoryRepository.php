<?php

namespace App\Repositories;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategories() {
        return Category::all();
    }

    public function getCategoryById($id) {
        return Category::find($id);
    }

    public function createCategory(array $data) {
        DB::beginTransaction();
        try {
            $category = Category::create($data);
            DB::commit();
            return $category;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Error in : ' . $e->getMessage());
        }
    }

    public function updateCategory($id, array $data) {
        DB::beginTransaction();
        try {
            $category = Category::where('id', $id)->update($data);
            DB::commit();
            return $category;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Error in : ' . $e->getMessage());
        }
    }

    public function deleteCategory($id) {
        DB::beginTransaction();
        try {
            $category = Category::destroy($id);
            DB::commit();
            return $category;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Error in : ' . $e->getMessage());
        }
    }
}
