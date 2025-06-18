@extends('layouts.app')

@section('title', 'Category Details')

@section('content')
<style>
    body {
        background: #1f2937; /* dark slate */
        color: #e5e7eb; /* light gray */
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
        color: #fbbf24; /* amber */
        text-shadow: 0 0 8px #fbbf24;
    }

    .card-body {
        padding: 1.5rem 2rem;
    }

    table.table {
        width: 100%;
        color: #e0e7ff;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 0.8rem;
        overflow: hidden;
        background-color: #1e293b;
        box-shadow: 0 0 12px #3b82f6aa;
    }

    table.table th,
    table.table td {
        padding: 1rem 1.5rem;
        text-align: left;
        border-bottom: 1px solid #374151;
        vertical-align: middle;
        font-size: 1rem;
    }

    table.table th {
        background: #2563eb;
        color: #fbbf24;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    table.table tbody tr:hover {
        background-color: #374151;
        transition: background-color 0.25s ease-in-out;
    }

    /* Badges */
    .badge {
        padding: 0.4em 0.85em;
        font-weight: 600;
        border-radius: 9999px;
        font-size: 0.85rem;
        color: #fff;
        display: inline-block;
        text-align: center;
        min-width: 72px;
    }

    .badge.bg-success {
        background-color: #22c55e;
        box-shadow: 0 0 10px #22c55eaa;
    }

    .badge.bg-danger {
        background-color: #ef4444;
        box-shadow: 0 0 10px #ef4444aa;
    }

    /* Statistics Cards */
    .statistics .border {
        border-color: #374151 !important;
        background-color: #1f2937 !important;
        box-shadow: 0 0 15px #3b82f6cc;
        color: #e0e7ff;
        transition: transform 0.3s ease;
    }

    .statistics .border:hover {
        transform: translateY(-5px);
        box-shadow: 0 0 25px #3b82f6ff;
    }

    .statistics h6 {
        color: #9ca3af;
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 1rem;
    }

    .statistics h3 {
        margin: 0;
        font-weight: 700;
        font-size: 2rem;
        color: #fbbf24;
        text-shadow: 0 0 8px #fbbf24;
    }

    /* Buttons */
    .btn-secondary {
        background-color: #374151;
        border: none;
        color: #9ca3af;
        font-weight: 600;
        border-radius: 0.6rem;
        padding: 0.6rem 1.2rem;
        box-shadow: 0 0 8px #374151cc;
        transition: all 0.3s ease;
    }
    .btn-secondary:hover {
        background-color: #2563eb;
        color: #fff;
        box-shadow: 0 0 15px #2563ebcc;
    }

    .btn-warning {
        background-color: #f59e0b;
        border: none;
        color: #1f2937;
        font-weight: 700;
        border-radius: 0.6rem;
        padding: 0.6rem 1.2rem;
        box-shadow: 0 0 15px #fbbf24cc;
        transition: all 0.3s ease;
    }
    .btn-warning:hover {
        background-color: #b45309;
        color: #fff;
        box-shadow: 0 0 20px #b45309cc;
    }

    .btn i {
        vertical-align: middle;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5>Category Details</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table">
                                <tr>
                                    <th>Name:</th>
                                    <td>{{ $category->name }}</td>
                                </tr>
                                <tr>
                                    <th>Description:</th>
                                    <td>{{ $category->description ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        @if($category->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6 statistics">
                            <div class="card bg-transparent border p-4">
                                <h6 class="card-title mb-4">Statistics</h6>
                                <div class="row g-3">
                                    <div class="col-6">
                                        <div class="border rounded p-3 text-center">
                                            <h6>Total Products</h6>
                                            <h3>{{ $category->products_count }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="border rounded p-3 text-center">
                                            <h6>Total Stock Value</h6>
                                            <h3>RWF {{ number_format($category->total_stock_value, 2) }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="border rounded p-3 text-center">
                                            <h6>Total Stock Quantity</h6>
                                            <h3>{{ number_format($category->total_stock_quantity) }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Products in Category</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Current Stock</th>
                                    <th>Minimum Stock</th>
                                    <th>Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($category->products as $product)
                                    <tr>
                                        <td>{{ $product->Product_Name }}</td>
                                        <td>{{ number_format($product->current_stock) }}</td>
                                        <td>{{ number_format($product->minimum_stock) }}</td>
                                        <td>
                                            @if($product->isLowStock())
                                                <span class="badge bg-danger">Low Stock</span>
                                            @else
                                                <span class="badge bg-success">In Stock</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="#" class="btn btn-sm btn-info" style="background: #3b82f6; border:none; box-shadow: 0 0 8px #3b82f6cc;">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-gray-400">No products in this category</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 d-flex gap-3">
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to Categories
        </a>
        <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">
            <i class="fas fa-edit me-2"></i> Edit Category
        </a>
    </div>
</div>
@endsection
