@extends('layouts.app')

@section('title', 'Record Stock In')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #141e30, #243b55);
        color: #fff;
    }

    .form-wrapper {
        max-width: 700px;
        margin: 40px auto;
        background: rgba(255, 255, 255, 0.05);
        padding: 2rem 2.5rem;
        border-radius: 1.5rem;
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(10px);
    }

    .form-wrapper h3 {
        text-align: center;
        margin-bottom: 2rem;
        color: #ffaeae;
        font-weight: 600;
    }

    .form-control,
    .form-label {
        color: #fff;
    }

    .form-control {
        background-color: rgba(255, 255, 255, 0.1);
        border: none;
        border-radius: 0.5rem;
    }

    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.15);
        color: #fff;
        box-shadow: none;
    }

    .invalid-feedback {
        color: #f88;
    }

    .form-text {
        color: #ccc;
    }

    .btn-neon {
        background: linear-gradient(to right, #ff416c, #ff4b2b);
        color: white;
        border: none;
        border-radius: 0.5rem;
    }

    .btn-outline {
        background: transparent;
        border: 1px solid #ccc;
        color: #ccc;
        border-radius: 0.5rem;
    }

    .btn-neon:hover,
    .btn-outline:hover {
        filter: brightness(1.1);
    }

    footer {
        margin-top: 40px;
        padding: 20px 0;
        text-align: center;
        color: #bbb;
        font-size: 0.85rem;
    }
</style>

<div class="container">
    <div class="form-wrapper">
        <h3>📥 Record Stock In</h3>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('stock.in.store') }}" method="POST">
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
                <label for="Date" class="form-label">Date</label>
                <input type="date" class="form-control @error('Date') is-invalid @enderror"
                       id="Date" name="Date" value="{{ old('Date', date('Y-m-d')) }}" required>
                @error('Date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="Quantity" class="form-label">Quantity</label>
                <input type="number" class="form-control @error('Quantity') is-invalid @enderror"
                       id="Quantity" name="Quantity" value="{{ old('Quantity') }}" min="1" required>
                @error('Quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="Unit_Price" class="form-label">Unit Price (RWF)</label>
                <input type="number" class="form-control @error('Unit_Price') is-invalid @enderror"
                       id="Unit_Price" name="Unit_Price" value="{{ old('Unit_Price') }}"
                       min="0" step="0.01" required>
                @error('Unit_Price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="Supplier" class="form-label">Supplier</label>
                <input type="text" class="form-control @error('Supplier') is-invalid @enderror"
                       id="Supplier" name="Supplier" value="{{ old('Supplier') }}" required>
                @error('Supplier')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="Reference_Number" class="form-label">Reference Number</label>
                <input type="text" class="form-control @error('Reference_Number') is-invalid @enderror"
                       id="Reference_Number" name="Reference_Number" value="{{ old('Reference_Number') }}" required>
                <div class="form-text">Enter a unique reference number for this stock entry</div>
                @error('Reference_Number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="Total_Price" class="form-label">Total Price (RWF)</label>
                <input type="number" class="form-control" id="Total_Price" readonly>
            </div>

            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-neon">Record Stock In</button>
                <a href="{{ route('dashboard') }}" class="btn btn-outline">Cancel</a>
            </div>
        </form>
    </div>
</div>

<footer>
    &copy; {{ date('Y') }} Sainte Anne Kitchen Stock System — All rights reserved.
</footer>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInput = document.getElementById('Quantity');
        const unitPriceInput = document.getElementById('Unit_Price');
        const totalPriceInput = document.getElementById('Total_Price');

        function calculateTotal() {
            const quantity = parseFloat(quantityInput.value) || 0;
            const unitPrice = parseFloat(unitPriceInput.value) || 0;
            totalPriceInput.value = (quantity * unitPrice).toFixed(2);
        }

        quantityInput.addEventListener('input', calculateTotal);
        unitPriceInput.addEventListener('input', calculateTotal);
    });
</script>
@endsection
