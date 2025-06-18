@extends('layouts.app')

@section('title', 'Stock Out Records')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #1f1c2c, #928dab);
        color: #f5f5f5;
        font-family: 'Segoe UI', sans-serif;
    }

    .dashboard-wrapper {
        max-width: 92%;
        margin: 3rem auto;
        padding: 2rem;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 1.5rem;
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.4);
    }

    h2 {
        font-weight: 700;
        font-size: 1.8rem;
        color: #fff;
    }

    .btn-issue {
        background: linear-gradient(to right, #ff416c, #ff4b2b);
        border: none;
        color: #fff;
        border-radius: 0.5rem;
        padding: 0.5rem 1rem;
    }

    .btn-issue:hover {
        filter: brightness(1.1);
    }

    .alert-success,
    .alert-warning {
        border-radius: 0.75rem;
        padding: 0.75rem 1rem;
        font-weight: 500;
    }

    .alert-success {
        background-color: rgba(40, 167, 69, 0.9);
        color: #fff;
    }

    .alert-warning {
        background-color: rgba(255, 193, 7, 0.9);
        color: #000;
    }

    .card {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 1rem;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.2);
    }

    .table {
        background-color: transparent;
        color: #f5f5f5;
    }

    .table thead {
        background-color: rgba(255, 255, 255, 0.07);
        color: #ffaeae;
    }

    .table th,
    .table td {
        vertical-align: middle;
        padding: 0.75rem 1rem;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .table-hover tbody tr:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .btn-group .btn {
        margin-right: 0.25rem;
    }

    .btn-info {
        background-color: #17a2b8;
        border: none;
    }

    .btn-warning {
        background-color: #ffc107;
        border: none;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
    }

    .pagination {
        justify-content: center;
    }

    .pagination .page-link {
        background-color: transparent;
        border: 1px solid #ccc;
        color: #fff;
    }

    .pagination .page-item.active .page-link {
        background-color: #ff4b2b;
        border-color: #ff4b2b;
        color: #fff;
    }

    footer {
        margin-top: 4rem;
        text-align: center;
        font-size: 0.85rem;
        color: #bbb;
    }
</style>

<div class="dashboard-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>📤 Stock Out Records</h2>
        <a href="{{ route('stock.out.create') }}" class="btn btn-issue">
            <i class="fas fa-minus-circle me-2"></i>Issue Stock
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif

    <div class="card p-3">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stockOuts as $stockOut)
                        <tr>
                            <td>{{ $stockOut->Date }}</td>
                            <td>{{ $stockOut->product->Product_Name }}</td>
                            <td>{{ $stockOut->Quantity }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('stock.out.show', $stockOut) }}" 
                                        class="btn btn-sm btn-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('stock.out.edit', $stockOut) }}" 
                                        class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('stock.out.destroy', $stockOut) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this record?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-light">No stock out records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $stockOuts->links() }}
        </div>
    </div>
</div>

<footer>
    &copy; {{ date('Y') }} Sainte Anne Kitchen Stock System — All rights reserved.
</footer>
@endsection
