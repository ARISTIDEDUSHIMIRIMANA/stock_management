@extends('layouts.app')

@section('title', 'Stock In Records')

@section('content')
<style>
    body {
        background: #1f2937; /* dark slate */
        color: #f3f4f6; /* light gray */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .stock-list-wrapper {
        max-width: 95%;
        margin: 3rem auto;
        padding: 2.5rem;
        background: #111827; /* darker slate */
        border-radius: 1rem;
        box-shadow: 0 8px 24px rgb(0 0 0 / 0.5);
    }

    .stock-list-wrapper h2 {
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

    /* Glass effect button */
    .btn-glass {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.15);
        color: #f3f4f6;
        border-radius: 0.6rem;
        box-shadow: 0 6px 15px rgb(0 0 0 / 0.2);
        transition: all 0.3s ease;
        padding: 0.5rem 1rem;
    }

    .btn-glass:hover {
        filter: brightness(1.15);
        box-shadow: 0 8px 20px rgb(0 0 0 / 0.4);
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

    .pagination {
        justify-content: center;
        margin-top: 2rem;
    }

    .pagination .page-link {
        background: transparent;
        border: 1.5px solid #60a5fa;
        color: #60a5fa;
        border-radius: 0.5rem;
        padding: 0.4rem 0.8rem;
        transition: background-color 0.3s ease;
    }

    .pagination .page-item.active .page-link {
        background-color: #3b82f6;
        border-color: #3b82f6;
        color: #fff;
        box-shadow: 0 0 12px #3b82f6cc;
    }

    .pagination .page-link:hover {
        background-color: #2563eb;
        color: #fff;
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
    <div class="stock-list-wrapper">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>📦 Stock In Records</h2>
            <a href="{{ route('stock.in.create') }}" class="btn-neon">
                <i class="fas fa-plus-circle me-2"></i> Add Stock
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover border border-light-subtle">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Unit Price (RWF)</th>
                        <th>Total Price (RWF)</th>
                        <th>Supplier</th>
                        <th>Reference</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stockIns as $stockIn)
                        <tr>
                            <td>{{ $stockIn->Date }}</td>
                            <td>{{ $stockIn->product->Product_Name }}</td>
                            <td>{{ $stockIn->Quantity }}</td>
                            <td>{{ number_format($stockIn->Unit_Price, 2) }}</td>
                            <td>{{ number_format($stockIn->Total_Price, 2) }}</td>
                            <td>{{ $stockIn->Supplier }}</td>
                            <td>{{ $stockIn->Reference_Number }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('stock.in.show', $stockIn) }}" 
                                       class="btn btn-sm btn-outline-neon" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('stock.in.edit', $stockIn) }}" 
                                       class="btn btn-sm btn-outline-neon" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('stock.in.destroy', $stockIn) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this record?');">
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
                            <td colspan="8" class="text-center text-light">No stock in records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            {{ $stockIns->links() }}
        </div>
    </div>
</div>

<footer>
    &copy; {{ date('Y') }} Sainte Anne Kitchen Stock System — All rights reserved.
</footer>
@endsection
