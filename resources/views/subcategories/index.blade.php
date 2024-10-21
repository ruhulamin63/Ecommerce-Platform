@extends('layouts.app')

@section('content')
    <h1>Subcategories</h1>

    <!-- Button to open the create subcategory modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createSubcategoryModal">
        Add Subcategory
    </button>

    <!-- Subcategories Table -->
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Slug</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($subcategories as $subcategory)
            <tr>
                <td>{{ $subcategory->name }}</td>
                <td>{{ $subcategory->slug }}</td>
                <td>{{ $subcategory->category->name }}</td>
                <td>
                    <!-- Button to open the edit subcategory modal -->
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editSubcategoryModal{{ $subcategory->id }}">
                        Edit
                    </button>

                    <!-- Button to open the delete confirmation modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteSubcategoryModal{{ $subcategory->id }}">
                        Delete
                    </button>
                </td>
            </tr>

            <!-- Edit Subcategory Modal -->
            <div class="modal fade" id="editSubcategoryModal{{ $subcategory->id }}" tabindex="-1" aria-labelledby="editSubcategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('subcategories.update', $subcategory->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="editSubcategoryModalLabel">Edit Subcategory</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $subcategory->name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control" name="slug" value="{{ $subcategory->slug }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select class="form-select" name="category_id" required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $subcategory->category_id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
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

            <!-- Delete Subcategory Modal -->
            <div class="modal fade" id="deleteSubcategoryModal{{ $subcategory->id }}" tabindex="-1" aria-labelledby="deleteSubcategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteSubcategoryModalLabel">Delete Subcategory</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete the subcategory "{{ $subcategory->name }}"?
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

    <!-- Create Subcategory Modal -->
    <div class="modal fade" id="createSubcategoryModal" tabindex="-1" aria-labelledby="createSubcategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('subcategories.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createSubcategoryModalLabel">Create Subcategory</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" name="slug" required>
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" name="category_id" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
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
