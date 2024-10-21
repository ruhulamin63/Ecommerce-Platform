<?php
namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll(){
        return Product::all();
    }

    public function getById($id){
        return Product::find($id);
    }

    public function create(array $data){
        DB::beginTransaction();
        try {
            $product = Product::create($data);
            DB::commit();
            return $product;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Error in : ' . $e->getMessage());
        }
    }

    public function update($id, array $data){
        DB::beginTransaction();
        try {
            $product = Product::find($id);
            if ($product) {
                $product->update($data);
                DB::commit();
                return $product;
            }
            return null;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Error in : ' . $e->getMessage());
        }
    }

    public function delete($id){
        DB::beginTransaction();
        try {
            $product = Product::destroy($id);
            DB::commit();
            return $product;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Error in : ' . $e->getMessage());
        }
    }

    public function getBySubcategoryId($subcategoryId){
        return Product::where('subcategory_id', $subcategoryId)->get();
    }
}
