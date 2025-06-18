@extends('layouts.app')

@section('title', 'Create Product')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Create New Product</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="Product_Name" class="form-label">Product Name</label>
                            <input type="text" class="form-control @error('Product_Name') is-invalid @enderror" 
                                   id="Product_Name" name="Product_Name" value="{{ old('Product_Name') }}" required>
                            @error('Product_Name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select @error('category_id') is-invalid @enderror" 
                                    id="category_id" name="category_id">
                                <option value="">Select Category</option>
                                @foreach(App\Models\Category::where('status', true)->get() as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Description" class="form-label">Description</label>
                            <textarea class="form-control @error('Description') is-invalid @enderror" 
                                      id="Description" name="Description" rows="3">{{ old('Description') }}</textarea>
                            @error('Description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Unit" class="form-label">Unit</label>
                            <input type="text" class="form-control @error('Unit') is-invalid @enderror" 
                                   id="Unit" name="Unit" value="{{ old('Unit') }}" required>
                            @error('Unit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="minimum_stock" class="form-label">Minimum Stock Level</label>
                            <input type="number" class="form-control @error('minimum_stock') is-invalid @enderror" 
                                   id="minimum_stock" name="minimum_stock" value="{{ old('minimum_stock', 0) }}" required>
                            @error('minimum_stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Create Product
                            </button>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Products
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 