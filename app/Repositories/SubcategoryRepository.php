<?php
namespace App\Repositories;

use App\Models\Subcategory;
use App\Repositories\Interfaces\SubcategoryRepositoryInterface;

class SubcategoryRepository implements SubcategoryRepositoryInterface
{
    public function getAll(){
        return Subcategory::all();
    }

    public function getById($id){
        return Subcategory::find($id);
    }

    public function create(array $data){
        return Subcategory::create($data);
    }

    public function update($id, array $data){
        $subcategory = Subcategory::find($id);
        if ($subcategory) {
            $subcategory->update($data);
            return $subcategory;
        }
        return null;
    }

    public function delete($id){
        return Subcategory::destroy($id);
    }

    public function getByCategoryId($categoryId){
        return Subcategory::where('category_id', $categoryId)->get();
    }
}
