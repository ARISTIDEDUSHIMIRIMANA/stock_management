@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
<style>
    body {
        background: #1f2937; /* dark slate */
        color: #f3f4f6; /* light gray */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .edit-category-wrapper {
        max-width: 600px;
        margin: 3rem auto;
        background: #111827; /* darker slate */
        border-radius: 1rem;
        box-shadow: 0 8px 24px rgb(0 0 0 / 0.6);
        padding: 2rem 2.5rem;
    }

    .edit-category-wrapper h5 {
        color: #fbbf24; /* amber */
        font-weight: 700;
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        text-align: center;
        text-shadow: 0 0 8px #fbbf24;
    }

    label {
        font-weight: 600;
        color: #d1d5db; /* lighter gray */
        margin-bottom: 0.4rem;
        display: block;
    }

    input.form-control,
    textarea.form-control,
    select.form-select {
        background-color: #1e293b;
        border: 1.8px solid #3b82f6;
        color: #e0e7ff;
        border-radius: 0.6rem;
        padding: 0.5rem 0.8rem;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    input.form-control:focus,
    textarea.form-control:focus,
    select.form-select:focus {
        border-color: #fbbf24;
        box-shadow: 0 0 12px #fbbf24aa;
        outline: none;
        background-color: #111827;
        color: #fff;
    }

    .is-invalid {
        border-color: #dc2626 !important;
        background-color: #422121 !important;
        color: #fee2e2 !important;
    }

    .invalid-feedback {
        color: #f87171;
        font-weight: 600;
        margin-top: 0.3rem;
    }

    .btn-primary {
        background: linear-gradient(90deg, #3b82f6, #60a5fa);
        border: none;
        color: white;
        font-weight: 700;
        border-radius: 0.7rem;
        padding: 0.6rem 1.2rem;
        box-shadow: 0 0 15px #3b82f6cc;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        filter: brightness(1.15);
        box-shadow: 0 0 25px #3b82f6ff;
    }

    .btn-outline-secondary {
        border: 1.8px solid #6b7280; /* gray-500 */
        color: #9ca3af;
        background: transparent;
        font-weight: 600;
        border-radius: 0.7rem;
        padding: 0.55rem 1.2rem;
        transition: all 0.3s ease;
    }

    .btn-outline-secondary:hover {
        background-color: #374151;
        color: #fbbf24;
        border-color: #fbbf24;
        box-shadow: 0 0 15px #fbbf24cc;
    }

    .d-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
        margin-top: 2rem;
    }
</style>

<div class="container">
    <div class="edit-category-wrapper">
        <h5>Edit Category</h5>
        <form action="{{ route('categories.update', $category) }}" method="POST" novalidate>
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="name">Category Name</label>
                <input type="text" 
                       class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" 
                       value="{{ old('name', $category->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="3">{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status">Status</label>
                <select class="form-select @error('status') is-invalid @enderror" 
                        id="status" name="status" required>
                    <option value="1" {{ old('status', $category->status) ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status', $category->status) ? '' : 'selected' }}>Inactive</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i> Update Category
                </button>
                <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary text-center">
                    <i class="fas fa-arrow-left me-2"></i> Back to Categories
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
