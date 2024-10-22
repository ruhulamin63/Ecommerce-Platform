@extends('layouts.app')

@section('content')
    <h1>Products</h1>

    <!-- Button to open the create product modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createProductModal">
        Add New
    </button>

    <!-- Products Table -->
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Subcategory</th>
            <th>Description</th>
            <th>Old Price</th>
            <th>New Price</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->subcategory->category->name }}</td>
                <td>{{ $product->subcategory->name }}</td>
                <td>{{ $product->desc }}</td>
                <td>৳ {{ $product->old_price }}</td>
                <td>৳ {{ $product->new_price }}</td>
                <td><img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="80"></td>
                <td>
                    <!-- Button to open the edit product modal -->
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editProductModal{{ $product->id }}">
                        Edit
                    </button>

                    <!-- Button to open the delete confirmation modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteProductModal{{ $product->id }}">
                        Delete
                    </button>
                </td>
            </tr>

            <!-- Edit Product Modal -->
            <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $product->name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="subcategory_id" class="form-label">Subcategory</label>
                                    <select class="form-select" name="subcategory_id" required>
                                        @foreach($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}" {{ $subcategory->id == $product->subcategory_id ? 'selected' : '' }}>
                                                {{ $subcategory->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="desc" class="form-label">Description</label>
                                    <textarea class="form-control" name="desc" required>{{ $product->desc }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="old_price" class="form-label">Old Price</label>
                                    <input type="number" class="form-control" name="old_price" value="{{ $product->old_price }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="new_price" class="form-label">New Price</label>
                                    <input type="number" class="form-control" name="new_price" value="{{ $product->new_price }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" name="image">
                                    <small>Current image: <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" width="50"></small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete Product Modal -->
            <div class="modal fade" id="deleteProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteProductModalLabel">Delete Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete the product "{{ $product->name }}"?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        @endforeach
        </tbody>
    </table>

    <!-- Create Product Modal -->
    <div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createProductModalLabel">Create Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="subcategory_id" class="form-label">Subcategory</label>
                            <select class="form-select" name="subcategory_id" required>
                                @foreach($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="desc"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="old_price" class="form-label">Old Price</label>
                            <input type="number" class="form-control" name="old_price" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_price" class="form-label">New Price</label>
                            <input type="number" class="form-control" name="new_price" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
