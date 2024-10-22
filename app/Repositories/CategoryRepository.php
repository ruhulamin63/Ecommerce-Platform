<?php

namespace App\Repositories;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    // Get all categories
    public function getAllCategories() {
        return $this->model->latest()->get();
    }

    // Get a category by ID
    public function getCategoryById($id) {
        return $this->model->findOrFail($id);
    }

    // Find a category by slug
    public function findBySlug($slug) {
        return $this->model->where('slug', $slug)->firstOrFail();
    }

    // Create a new category
    public function createCategory(array $data) {
        DB::beginTransaction();
        try {
            $category = $this->model->create($data);
            DB::commit();

            return $category;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Error in : ' . $e->getMessage());
        }
    }

    // Update a category
    public function updateCategory($id, array $data) {
        DB::beginTransaction();
        try {
            $category = $this->model->findOrFail($id);
            $category->update($data);
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
            $category = $this->model->findOrFail($id);
            $category->delete();
            DB::commit();

            return $category;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Error in : ' . $e->getMessage());
        }
    }
}
