@extends('layouts.app')

@section('title', 'Edit Stock In Record')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #141e30, #243b55);
        color: #fff;
    }

    .edit-wrapper {
        max-width: 750px;
        margin: 3rem auto;
        padding: 2rem;
        background: rgba(255, 255, 255, 0.06);
        border-radius: 1.5rem;
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);
    }

    .edit-wrapper h5 {
        color: #ffaeae;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }

    .form-label {
        color: #ddd;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #fff;
    }

    .form-control:focus {
        background: rgba(255, 255, 255, 0.07);
        border-color: #ff4b2b;
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
    }

    .btn-neon:hover, .btn-outline-neon:hover {
        filter: brightness(1.1);
    }

    .alert-danger {
        background-color: rgba(220, 53, 69, 0.85);
        border-radius: 0.75rem;
        padding: 0.75rem 1rem;
        color: #fff;
    }
</style>

<div class="edit-wrapper">
    <h5>✏️ Edit Stock In Record</h5>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('stock.in.update', $stockIn) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="Product_Name" class="form-label">Product Name</label>
            <input type="text" class="form-control @error('Product_Name') is-invalid @enderror"
                   id="Product_Name" name="Product_Name"
                   value="{{ old('Product_Name', $stockIn->product->Product_Name) }}" required>
            @error('Product_Name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="Date" class="form-label">Date</label>
            <input type="date" class="form-control @error('Date') is-invalid @enderror"
                   id="Date" name="Date" value="{{ old('Date', $stockIn->Date) }}" required>
            @error('Date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="Quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control @error('Quantity') is-invalid @enderror"
                   id="Quantity" name="Quantity" value="{{ old('Quantity', $stockIn->Quantity) }}"
                   min="1" required>
            @error('Quantity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="Unit_Price" class="form-label">Unit Price (RWF)</label>
            <input type="number" class="form-control @error('Unit_Price') is-invalid @enderror"
                   id="Unit_Price" name="Unit_Price"
                   value="{{ old('Unit_Price', $stockIn->Unit_Price) }}"
                   min="0" step="0.01" required>
            @error('Unit_Price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="Total_Price" class="form-label">Total Price (RWF)</label>
            <input type="number" class="form-control" id="Total_Price" readonly
                   value="{{ $stockIn->Total_Price }}">
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-neon">💾 Update</button>
            <a href="{{ route('stock.in.index') }}" class="btn btn-outline-neon">↩️ Cancel</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.querySelectorAll('#Quantity, #Unit_Price').forEach(input => {
        input.addEventListener('input', calculateTotal);
    });

    function calculateTotal() {
        const quantity = parseFloat(document.getElementById('Quantity').value) || 0;
        const unitPrice = parseFloat(document.getElementById('Unit_Price').value) || 0;
        const total = quantity * unitPrice;
        document.getElementById('Total_Price').value = total.toFixed(2);
    }
</script>
@endsection
