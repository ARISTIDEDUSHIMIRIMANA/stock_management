@extends('layouts.app')

@section('title', 'Product Categories')

@section('content')
<style>
    body {
        background: #1f2937; /* dark slate */
        color: #f3f4f6; /* light gray */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .categories-wrapper {
        max-width: 95%;
        margin: 3rem auto;
        padding: 2.5rem;
        background: #111827; /* darker slate */
        border-radius: 1rem;
        box-shadow: 0 8px 24px rgb(0 0 0 / 0.5);
    }

    .categories-wrapper h2 {
        color: #fbbf24; /* amber */
        font-weight: 700;
        font-size: 2rem;
        margin-bottom: 1.8rem;
        letter-spacing: 0.03em;
        text-shadow: 0 0 10px #fbbf24;
    }

    .btn-neon {
        background: linear-gradient(90deg, #3b82f6, #60a5fa);
        border: none;
        color: #fff;
        border-radius: 0.6rem;
        padding: 0.5rem 1.2rem;
        font-weight: 600;
        box-shadow: 0 0 15px #3b82f6aa;
        transition: all 0.3s ease;
    }

    .btn-neon:hover {
        filter: brightness(1.15);
        box-shadow: 0 0 25px #3b82f6ff;
    }

    .btn-outline-neon {
        border: 1.8px solid #3b82f6;
        color: #3b82f6;
        border-radius: 0.6rem;
        padding: 0.4rem 1rem;
        font-weight: 600;
        background: transparent;
        transition: all 0.3s ease;
    }

    .btn-outline-neon:hover {
        background: #3b82f6;
        color: #fff;
        box-shadow: 0 0 12px #3b82f6cc;
    }

    /* Table styling */
    .table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 1rem;
        overflow: hidden;
        background-color: #1e293b; /* slate blue */
        box-shadow: 0 0 20px rgb(59 130 246 / 0.25);
    }

    thead {
        background: #2563eb; /* blue */
        color: #e0e7ff; /* light blue */
    }

    th, td {
        padding: 0.85rem 1.3rem;
        font-size: 0.95rem;
        color: #e0e7ff;
        border-bottom: 1px solid #374151;
        vertical-align: middle;
        text-align: left;
    }

    tbody tr:hover {
        background-color: #3b82f6aa;
        cursor: pointer;
        transition: background-color 0.3s ease-in-out;
    }

    .table-responsive {
        border-radius: 1rem;
        overflow-x: auto;
    }

    .btn-group .btn {
        margin-right: 0.4rem;
    }

    .alert-success {
        background-color: #22c55e;
        border-radius: 0.8rem;
        padding: 0.9rem 1.3rem;
        color: #e9f5ec;
        font-weight: 600;
        box-shadow: 0 0 15px #22c55ecc;
    }

    .alert-danger {
        background-color: #dc2626; /* red-600 */
        border-radius: 0.8rem;
        padding: 0.9rem 1.3rem;
        color: #fef2f2;
        font-weight: 600;
        box-shadow: 0 0 15px #dc2626cc;
    }

    .badge-info {
        background-color: #3b82f6; /* blue */
        color: white;
        font-weight: 600;
        border-radius: 0.6rem;
        padding: 0.3rem 0.7rem;
    }

    .badge-success {
        background-color: #22c55e; /* green */
        font-weight: 600;
        border-radius: 0.6rem;
        padding: 0.3rem 0.7rem;
        color: white;
    }

    .badge-danger {
        background-color: #dc2626; /* red */
        font-weight: 600;
        border-radius: 0.6rem;
        padding: 0.3rem 0.7rem;
        color: white;
    }

    footer {
        margin-top: 4rem;
        text-align: center;
        font-size: 0.9rem;
        color: #9ca3af;
        letter-spacing: 0.05em;
    }
</style>

<div class="container">
    <div class="categories-wrapper">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>🗂️ Product Categories</h2>
            <a href="{{ route('categories.create') }}" class="btn-neon">
                <i class="fas fa-plus-circle me-2"></i> Add Category
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Products</th>
                        <th>Status</th>
                        <th>Total Stock Value</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description ?? 'N/A' }}</td>
                            <td>
                                <span class="badge-info">
                                    {{ $category->products_count }} products
                                </span>
                            </td>
                            <td>
                                @if($category->status)
                                    <span class="badge-success">Active</span>
                                @else
                                    <span class="badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>RWF {{ number_format($category->total_stock_value, 2) }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('categories.show', $category) }}" 
                                       class="btn btn-sm btn-outline-neon" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('categories.edit', $category) }}" 
                                       class="btn btn-sm btn-outline-neon" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('categories.destroy', $category) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-neon" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-light">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<footer>
    &copy; {{ date('Y') }} Sainte Anne Kitchen Stock System — All rights reserved.
</footer>
@endsection
