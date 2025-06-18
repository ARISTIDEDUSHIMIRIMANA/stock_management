@extends('layouts.app')

@section('title', 'Stock Out Reports')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Stock Out Reports</h2>
        <button onclick="window.print()" class="btn btn-primary d-print-none">
            <i class="fas fa-print me-2"></i>Print Report
        </button>
    </div>

    <div class="card mb-4 d-print-none">
        <div class="card-body">
            <form method="GET" action="{{ route('reports.stock.out') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="product_id" class="form-label">Product</label>
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
                    <label for="date_range" class="form-label">Date Range</label>
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
                    <label for="hour_range" class="form-label">Hour</label>
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
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" 
                           value="{{ request('start_date') }}">
                </div>

                <div class="col-md-4 custom-date" style="display: none;">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" 
                           value="{{ request('end_date') }}">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter me-2"></i>Apply Filters
                    </button>
                    <a href="{{ route('reports.stock.out') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-undo me-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-none d-print-block mb-4">
                <h3 class="text-center">Ecole Primaire Sainte Anne</h3>
                <h4 class="text-center">Stock Out Report</h4>
                <p class="text-center">Generated on: {{ now()->format('Y-m-d H:i:s') }}</p>
                <hr>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Department</th>
                            <th>Issued By</th>
                            <th>Received By</th>
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
                                <td>{{ $item->Department }}</td>
                                <td>{{ $item->Issued_By }}</td>
                                <td>{{ $item->Received_By }}</td>
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
                            <td colspan="4"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-none d-print-block mt-4">
                <hr>
                <div class="row mt-4">
                    <div class="col-6">
                        <p>Issued by: _____________________</p>
                    </div>
                    <div class="col-6 text-end">
                        <p>Approved by: _____________________</p>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-4 d-print-none">
                {{ $data->links() }}
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    @media print {
        body {
            background: white;
        }
        .card {
            border: none;
        }
        .card-body {
            padding: 0;
        }
        .badge {
            border: 1px solid #000;
        }
        .table {
            width: 100% !important;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }
        .table th,
        .table td {
            padding: 0.75rem;
            border-top: 1px solid #dee2e6;
        }
        .table thead th {
            border-bottom: 2px solid #dee2e6;
        }
        @page {
            margin: 2cm;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.getElementById('date_range').addEventListener('change', function() {
        const customDateFields = document.querySelectorAll('.custom-date');
        if (this.value === 'custom') {
            customDateFields.forEach(field => field.style.display = 'block');
        } else {
            customDateFields.forEach(field => field.style.display = 'none');
        }
    });

    // Show custom date fields if custom range is selected
    if (document.getElementById('date_range').value === 'custom') {
        document.querySelectorAll('.custom-date').forEach(field => field.style.display = 'block');
    }
</script>
@endpush
@endsection 