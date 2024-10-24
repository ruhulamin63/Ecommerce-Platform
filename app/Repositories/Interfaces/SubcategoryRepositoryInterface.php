<?php
namespace App\Repositories\Interfaces;

use App\Models\Subcategory;

interface SubcategoryRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function findBySlug($slug);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getByCategoryId($categoryId);
}
