<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\SubcategoryRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $subcategoryRepository;
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository, SubcategoryRepositoryInterface $subcategoryRepository){
        $this->subcategoryRepository = $subcategoryRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(){
        $subcategories = $this->subcategoryRepository->getAll();
        $products = $this->productRepository->getAll();

        return view('products.index', compact('subcategories', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request){

        $data = $request->validated();

        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = $imagePath;
        }
        $this->productRepository->create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id){
        $product = $this->productRepository->getById($id);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id){
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            // Update image
            $imagePath = $request->file('image')->store('products', 'public');
            $validatedData['image'] = $imagePath;
        }
        $this->productRepository->update($id, $validatedData);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){
        $this->productRepository->delete($id);

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
