@extends('layouts.app')

@section('title', 'View Stock In Record')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #141e30, #243b55);
        color: #fff;
    }

    .view-wrapper {
        max-width: 900px;
        margin: 3rem auto;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 1.5rem;
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);
        padding: 2rem;
    }

    .view-wrapper h5 {
        color: #ffaeae;
        font-weight: 600;
    }

    .table-bordered {
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 0.5rem;
        overflow: hidden;
        background: transparent;
    }

    .table-bordered th,
    .table-bordered td {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.08);
        color: #e0e0e0;
        padding: 0.75rem 1rem;
        vertical-align: middle;
        text-shadow: 0 0 2px #000;
    }

    .table-bordered th {
        background: rgba(255, 255, 255, 0.08);
        color: #ff9d9d;
        font-weight: 600;
        border-right: 1px solid rgba(255, 255, 255, 0.1);
    }

    .table-bordered td {
        border-left: none;
    }

    .table-responsive {
        margin-top: 1rem;
        border-radius: 1rem;
        overflow: hidden;
    }

    .badge.bg-info {
        background-color: #17a2b8;
        color: #fff;
    }

    .badge.bg-secondary {
        background-color: #6c757d;
        color: #fff;
    }

    .btn-neon {
        background: linear-gradient(to right, #ff416c, #ff4b2b);
        border: none;
        color: #fff;
        border-radius: 0.5rem;
    }

    .btn-outline-neon {
        border: 1px solid #ff4b2b;
        color: #ff4b2b;
        border-radius: 0.5rem;
        background: transparent;
    }

    .btn-warning {
        background-color: #ffc107;
        border: none;
        color: #000;
        border-radius: 0.5rem;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
        border-radius: 0.5rem;
        color: #fff;
    }

    .btn:hover {
        filter: brightness(1.1);
    }
</style>

<div class="view-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5>📦 Stock In Record Details</h5>
        <a href="{{ route('stock.in.index') }}" class="btn btn-outline-neon btn-sm">
            <i class="fas fa-arrow-left me-1"></i>Back to List
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Reference Number</th>
                    <td>{{ $stockIn->Reference_Number }}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ $stockIn->Date->format('F d, Y') }}</td>
                </tr>
                <tr>
                    <th>Product</th>
                    <td>{{ $stockIn->product->Product_Name }}</td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td>
                        @if($stockIn->product->category)
                            <span class="badge bg-info">{{ $stockIn->product->category->name }}</span>
                        @else
                            <span class="badge bg-secondary">Uncategorized</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Supplier</th>
                    <td>{{ $stockIn->Supplier }}</td>
                </tr>
                <tr>
                    <th>Quantity</th>
                    <td>{{ number_format($stockIn->Quantity) }}</td>
                </tr>
                <tr>
                    <th>Unit Price</th>
                    <td>RWF {{ number_format($stockIn->Unit_Price, 2) }}</td>
                </tr>
                <tr>
                    <th>Total Price</th>
                    <td>RWF {{ number_format($stockIn->Total_Price, 2) }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $stockIn->created_at->format('F d, Y H:i:s') }}</td>
                </tr>
                <tr>
                    <th>Last Updated</th>
                    <td>{{ $stockIn->updated_at->format('F d, Y H:i:s') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mt-4 d-flex gap-2">
        <a href="{{ route('stock.in.edit', $stockIn) }}" class="btn btn-warning">
            <i class="fas fa-edit me-1"></i>Edit Record
        </a>
        <form action="{{ route('stock.in.destroy', $stockIn) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this record?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash me-1"></i>Delete Record
            </button>
        </form>
    </div>
</div>
@endsection
