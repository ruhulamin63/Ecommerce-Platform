<?php
namespace App\Repositories;

use App\Models\Subcategory;
use App\Repositories\Interfaces\SubcategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class SubcategoryRepository implements SubcategoryRepositoryInterface
{
    public function getAll(){
        return Subcategory::all();
    }

    public function getById($id){
        return Subcategory::find($id);
    }

    public function create(array $data){
        DB::beginTransaction();
        try {
            $subcategory = Subcategory::create($data);
            DB::commit();
            return $subcategory;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    public function update($id, array $data){
        DB::beginTransaction();
        try {
            $subcategory = Subcategory::find($id);
            if ($subcategory) {
                $subcategory->update($data);
                DB::commit();
                return $subcategory;
            }
            return null;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    public function delete($id){
        DB::beginTransaction();
        try {
            $subcategory = Subcategory::find($id);
            if ($subcategory) {
                $subcategory->delete();
                DB::commit();
                return $subcategory;
            }
            return null;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    public function getByCategoryId($categoryId){
        return Subcategory::where('category_id', $categoryId)->get();
    }
}
