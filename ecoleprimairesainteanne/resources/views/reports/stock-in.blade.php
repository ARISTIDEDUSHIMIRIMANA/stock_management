@extends('layouts.app')

@section('title', 'Stock In Reports')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #141e30, #243b55);
        color: #eee;
    }

    .container {
        max-width: 1200px;
    }

    /* Card style with transparent dark background and subtle glow */
    .card {
        background: rgba(255, 255, 255, 0.07);
        border-radius: 1rem;
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
        border: none;
        color: #ddd;
    }

    .card-header, .card-body {
        padding: 1.5rem;
    }

    h2 {
        color: #ffaeae;
        font-weight: 600;
    }

    /* Form labels and selects */
    label {
        color: #ffaeae;
        font-weight: 600;
    }

    .form-select, input[type="date"] {
        background: rgba(255, 255, 255, 0.1);
        border: none;
        color: #eee;
        border-radius: 0.5rem;
        padding: 0.5rem 0.75rem;
        transition: background 0.3s;
    }
    .form-select:focus, input[type="date"]:focus {
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
        outline: none;
        box-shadow: 0 0 8px #ff4b2b;
    }

    /* Buttons with neon style */
    .btn-primary {
        background: linear-gradient(to right, #ff416c, #ff4b2b);
        border: none;
        border-radius: 0.5rem;
        color: #fff;
        transition: filter 0.3s;
    }
    .btn-primary:hover {
        filter: brightness(1.1);
    }
    .btn-outline-secondary {
        color: #ff4b2b;
        border: 1px solid #ff4b2b;
        border-radius: 0.5rem;
        background: transparent;
        transition: filter 0.3s;
    }
    .btn-outline-secondary:hover {
        filter: brightness(1.1);
        background: rgba(255, 75, 43, 0.1);
    }

    /* Table styles */
    table {
        color: #eee;
        border-collapse: separate;
        border-spacing: 0 0.5rem;
        width: 100%;
    }
    thead th {
        color: #ffaeae;
        font-weight: 600;
        border-bottom: 2px solid #ff4b2b;
        padding-bottom: 0.75rem;
    }
    tbody tr {
        background: rgba(255, 255, 255, 0.07);
        border-radius: 0.75rem;
        box-shadow: 0 0 10px rgba(255, 75, 43, 0.15);
        transition: background 0.3s;
    }
    tbody tr:hover {
        background: rgba(255, 75, 43, 0.2);
    }
    tbody td {
        padding: 0.75rem 1rem;
        vertical-align: middle;
    }

    /* Badges */
    .badge.bg-info {
        background-color: #4dabf7;
    }
    .badge.bg-secondary {
        background-color: #6c757d;
    }

    /* Pagination */
    .pagination .page-link {
        background: rgba(255, 75, 43, 0.1);
        color: #ff4b2b;
        border: none;
        border-radius: 0.5rem;
        margin: 0 0.25rem;
        transition: background 0.3s;
    }
    .pagination .page-link:hover, .pagination .page-item.active .page-link {
        background: #ff4b2b;
        color: #fff;
    }

    /* Custom date fields toggling */
    .custom-date {
        margin-top: 1rem;
    }
</style>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Stock In Reports</h2>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('reports.stock.in') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="product_id">Product</label>
                    <select name="product_id" id="product_id" class="form-select">
                        <option value="">All Products</option>
                        @foreach($products as $product)
                            <option value="{{ $product->ProductId }}" {{ request('product_id') == $product->ProductId ? 'selected' : '' }}>
                                {{ $product->Product_Name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="date_range">Date Range</label>
                    <select name="date_range" id="date_range" class="form-select">
                        <option value="">All Time</option>
                        <option value="today" {{ request('date_range') == 'today' ? 'selected' : '' }}>Today</option>
                        <option value="week" {{ request('date_range') == 'week' ? 'selected' : '' }}>This Week</option>
                        <option value="month" {{ request('date_range') == 'month' ? 'selected' : '' }}>This Month</option>
                        <option value="year" {{ request('date_range') == 'year' ? 'selected' : '' }}>This Year</option>
                        <option value="custom" {{ request('date_range') == 'custom' ? 'selected' : '' }}>Custom Range</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="hour_range">Hour</label>
                    <select name="hour_range" id="hour_range" class="form-select">
                        <option value="">All Hours</option>
                        @for($i = 0; $i < 24; $i++)
                            <option value="{{ $i }}" {{ request('hour_range') == $i ? 'selected' : '' }}>
                                {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-4 custom-date" style="display: none;">
                    <label for="start_date">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" 
                           value="{{ request('start_date') }}">
                </div>

                <div class="col-md-4 custom-date" style="display: none;">
                    <label for="end_date">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" 
                           value="{{ request('end_date') }}">
                </div>

                <div class="col-12 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter me-2"></i>Apply Filters
                    </button>
                    <a href="{{ route('reports.stock.in') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-undo me-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-3">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                            <th>Supplier</th>
                            <th>Reference</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $item)
                            <tr>
                                <td>{{ $item->Date }}</td>
                                <td>{{ $item->product->Product_Name }}</td>
                                <td>
                                    @if($item->product->category)
                                        <span class="badge bg-info">{{ $item->product->category->name }}</span>
                                    @else
                                        <span class="badge bg-secondary">Uncategorized</span>
                                    @endif
                                </td>
                                <td>{{ number_format($item->Quantity) }}</td>
                                <td>RWF {{ number_format($item->Unit_Price, 2) }}</td>
                                <td>RWF {{ number_format($item->Total_Price, 2) }}</td>
                                <td>{{ $item->Supplier }}</td>
                                <td>{{ $item->Reference_Number }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No records found</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"><strong>Total</strong></td>
                            <td><strong>{{ number_format($data->sum('Quantity')) }}</strong></td>
                            <td></td>
                            <td><strong>RWF {{ number_format($data->sum('Total_Price'), 2) }}</strong></td>
                            <td colspan="2"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $data->links() }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const dateRangeSelect = document.getElementById('date_range');
    const customDateFields = document.querySelectorAll('.custom-date');

    function toggleCustomDates() {
        if (dateRangeSelect.value === 'custom') {
            customDateFields.forEach(field => field.style.display = 'block');
        } else {
            customDateFields.forEach(field => field.style.display = 'none');
        }
    }

    dateRangeSelect.addEventListener('change', toggleCustomDates);

    // Initialize on page load
    toggleCustomDates();
</script>
@endpush

@endsection
