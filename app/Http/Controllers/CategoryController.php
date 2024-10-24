<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use app\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(){
        $categories = $this->categoryRepository->getAllCategories();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request){
        try{
            $validatedData = $request->validated();
            $this->categoryRepository->createCategory($validatedData);

            return redirect()->route('categories.index')->with('success', 'Category created successfully.');
        }catch(\Exception $e){
            throw new \Exception('Error in : ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug){
        $category = $this->categoryRepository->findBySlug($slug);
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id){
        $category = $this->categoryRepository->getCategoryById($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update (CategoryRequest $request, string $id){
        $validatedData = $request->validated();
        $this->categoryRepository->updateCategory($id, $validatedData);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){
        $this->categoryRepository->deleteCategory($id);
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
