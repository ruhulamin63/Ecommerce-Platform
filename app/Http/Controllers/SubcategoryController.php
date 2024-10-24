<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategoryRequest;
use app\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\SubcategoryRepositoryInterface;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    protected $categoryRepository;
    protected $subcategoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository, SubcategoryRepositoryInterface $subcategoryRepository){
        $this->categoryRepository = $categoryRepository;
        $this->subcategoryRepository = $subcategoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(){
        $categories = $this->categoryRepository->getAllCategories();
        $subcategories = $this->subcategoryRepository->getAll();
        return view('subcategories.index', compact('categories','subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view('subcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoryRequest $request){
        $validatedData = $request->validated();
        $this->subcategoryRepository->create($validatedData);

        return redirect()->route('subcategories.index')->with('success', 'Subcategory created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug){
        $subcategory = $this->subcategoryRepository->findBySlug($slug);
        return view('subcategories.show', compact('subcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id){
        $subcategory = $this->subcategoryRepository->getById($id);
        return view('subcategories.edit', compact('subcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubCategoryRequest $request, string $id){
        $validatedData = $request->validated();
        $this->subcategoryRepository->update($id, $validatedData);

        return redirect()->route('subcategories.index')->with('success', 'Subcategory updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){
        $this->subcategoryRepository->delete($id);
        return redirect()->route('subcategories.index')->with('success', 'Subcategory deleted successfully.');
    }
}
