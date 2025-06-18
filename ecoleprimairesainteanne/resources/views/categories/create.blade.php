@extends('layouts.app')

@section('title', 'Create Category')

@section('content')
<style>
    body {
        background: #1f2937;
        color: #e5e7eb;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container {
        max-width: 96%;
        margin: 3rem auto;
    }

    .card {
        background: #111827;
        border-radius: 1rem;
        box-shadow: 0 8px 24px rgb(0 0 0 / 0.6);
        border: none;
        color: #d1d5db;
        margin-bottom: 2rem;
    }

    .card-header {
        background: #1f2937;
        border-bottom: 1px solid #374151;
        padding: 1rem 2rem;
        border-radius: 1rem 1rem 0 0;
    }

    .card-header h5 {
        margin: 0;
        font-weight: 700;
        font-size: 1.7rem;
        color: #fbbf24;
        text-shadow: 0 0 8px #fbbf24;
    }

    .card-body {
        padding: 1.5rem 2rem;
    }

    label.form-label {
        font-weight: 600;
        color: #fbbf24;
        font-size: 1rem;
    }

    input.form-control,
    textarea.form-control,
    select.form-select {
        background-color: #1e293b;
        border: 1.5px solid #374151;
        color: #e0e7ff;
        border-radius: 0.6rem;
        padding: 0.6rem 1rem;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    input.form-control:focus,
    textarea.form-control:focus,
    select.form-select:focus {
        border-color: #fbbf24;
        box-shadow: 0 0 8px #fbbf24aa;
        outline: none;
        color: #fff;
    }

    .is-invalid {
        border-color: #ef4444 !important;
        box-shadow: 0 0 8px #ef4444aa !important;
        color: #fff !important;
    }

    .invalid-feedback {
        color: #ef4444;
        font-weight: 600;
        margin-top: 0.3rem;
        font-size: 0.875rem;
    }

    .d-grid.gap-2 > button.btn-primary {
        background-color: #2563eb;
        border: none;
        border-radius: 0.6rem;
        padding: 0.75rem 1.2rem;
        font-weight: 700;
        font-size: 1.1rem;
        box-shadow: 0 0 15px #2563ebcc;
        transition: all 0.3s ease;
        color: #fff;
    }

    .d-grid.gap-2 > button.btn-primary:hover {
        background-color: #1d4ed8;
        box-shadow: 0 0 25px #1d4ed8cc;
        color: #fff;
    }

    .btn-outline-secondary {
        color: #9ca3af;
        border: 2px solid #374151;
        background-color: transparent;
        border-radius: 0.6rem;
        padding: 0.75rem 1.2rem;
        font-weight: 600;
        box-shadow: 0 0 8px #374151cc;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-outline-secondary:hover {
        background-color: #2563eb;
        border-color: #2563eb;
        color: #fff;
        box-shadow: 0 0 15px #2563ebcc;
        text-decoration: none;
    }

    .btn i {
        margin-right: 0.5rem;
        vertical-align: middle;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Create Category</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" name="status" required>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i>Create Category
                            </button>
                            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i>Back to Categories
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
