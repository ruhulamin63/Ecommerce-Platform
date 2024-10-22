<?php
namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Product $product) {
        $this->model = $product;
    }

    // Get all products
    public function getAll(){
        return $this->model->latest()->get();
    }

    // Get a product by ID
    public function getById($id){
        return $this->model->findOrFail($id);
    }

    // Create a new product
    public function create(array $data){
        DB::beginTransaction();
        try {
            $product = $this->model->create($data);
            DB::commit();

            return $product;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Error in : ' . $e->getMessage());
        }
    }

    // Update a product
    public function update($id, array $data){
        DB::beginTransaction();
        try {
            $product = $this->model->findOrFail($id);
            $product->update($data);
            DB::commit();

            return $product;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Error in : ' . $e->getMessage());
        }
    }

    // Delete a product
    public function delete($id){
        DB::beginTransaction();
        try {
            $product = $this->model->findOrFail($id);
            $product->delete();
            DB::commit();

            return $product;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Error in : ' . $e->getMessage());
        }
    }

    // Get products by subcategory ID
    public function getBySubcategoryId($subcategoryId){
        return $this->model->where('subcategory_id', $subcategoryId)->get();
    }
}
