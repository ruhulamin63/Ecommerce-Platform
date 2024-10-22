<?php
namespace App\Repositories;

use App\Models\Subcategory;
use App\Repositories\Interfaces\SubcategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class SubcategoryRepository implements SubcategoryRepositoryInterface
{
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Subcategory $subcategory) {
        $this->model = $subcategory;
    }

    // Get all subcategories
    public function getAll(){
        return $this->model->latest()->get();
    }

    // Get a subcategory by ID
    public function getById($id){
        return $this->model->findOrFail($id);
    }

    // Create a new subcategory
    public function create(array $data){
        DB::beginTransaction();
        try {
            $subcategory = $this->model->create($data);
            DB::commit();

            return $subcategory;
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    // Update a subcategory
    public function update($id, array $data){
        DB::beginTransaction();
        try {
            $subcategory = $this->model->findOrFail($id);
            $subcategory->update($data);
            DB::commit();

            return $subcategory;
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function delete($id){
        DB::beginTransaction();
        try {
            $subcategory = $this->model->findOrFail($id);
            $subcategory->delete();
            DB::commit();

            return $subcategory;
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function getByCategoryId($categoryId){
        return $this->model->where('category_id', $categoryId)->get();
    }

    // Find a subcategory by slug
    public function findBySlug($slug) {
        return $this->model->where('slug', $slug)->firstOrFail();
    }
}
