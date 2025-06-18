@extends('layouts.app')

@section('title', 'Edit Stock Out Record')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #1e1e2f, #3e3e70);
        color: #f5f5f5;
        font-family: 'Segoe UI', sans-serif;
    }

    .form-wrapper {
        max-width: 700px;
        margin: 4rem auto;
        padding: 2rem;
        background: rgba(255, 255, 255, 0.06);
        backdrop-filter: blur(15px);
        border-radius: 1.25rem;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
    }

    .form-wrapper h5 {
        font-weight: 700;
        font-size: 1.5rem;
        color: #fff;
        margin-bottom: 1rem;
    }

    label {
        font-weight: 500;
    }

    .form-control,
    .form-select {
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 0.5rem;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #00d4ff;
        box-shadow: 0 0 0 0.2rem rgba(0, 212, 255, 0.3);
        background-color: rgba(255, 255, 255, 0.15);
        color: #fff;
    }

    .invalid-feedback {
        color: #ff6b6b;
    }

    .alert-danger {
        background-color: rgba(220, 53, 69, 0.9);
        color: white;
        border-radius: 0.75rem;
    }

    .btn-primary {
        background: linear-gradient(to right, #00c6ff, #0072ff);
        border: none;
        font-weight: bold;
    }

    .btn-primary:hover {
        filter: brightness(1.1);
    }

    .btn-outline-secondary {
        color: #fff;
        border-color: #ccc;
    }

    .btn-outline-secondary:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .form-text {
        color: #ccc;
    }
</style>

<div class="form-wrapper">
    <h5><i class="fas fa-edit me-2"></i>Edit Stock Out Record</h5>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('stock.out.update', $stockOut) }}" method="POST" id="stockOutForm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="Product_Id" class="form-label">Product</label>
            <select name="Product_Id" id="Product_Id" class="form-select @error('Product_Id') is-invalid @enderror" required>
                <option value="">Select Product</option>
                @foreach($products as $product)
                    <option value="{{ $product->ProductId }}" 
                            data-available="{{ $product->available_stock }}"
                            {{ old('Product_Id', $stockOut->Product_Id) == $product->ProductId ? 'selected' : '' }}>
                        {{ $product->Product_Name }} (Available: {{ $product->available_stock }})
                    </option>
                @endforeach
            </select>
            @error('Product_Id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="Date" class="form-label">Date</label>
            <input type="date" class="form-control @error('Date') is-invalid @enderror" 
                   id="Date" name="Date" value="{{ old('Date', $stockOut->Date) }}" required>
            @error('Date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="Quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control @error('Quantity') is-invalid @enderror" 
                   id="Quantity" name="Quantity" value="{{ old('Quantity', $stockOut->Quantity) }}" min="1" required>
            <div id="availableStockHelp" class="form-text text-muted">
                Available stock: <span id="availableStockDisplay">0</span><br>
                <small>(Current quantity will be added back to available stock for calculation)</small>
            </div>
            @error('Quantity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary" id="submitButton">
                <i class="fas fa-save me-1"></i>Update Stock Out Record
            </button>
            <a href="{{ route('stock.out.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>Cancel
            </a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('Product_Id').addEventListener('change', updateAvailableStock);
    document.getElementById('Quantity').addEventListener('input', validateQuantity);

    function updateAvailableStock() {
        const select = document.getElementById('Product_Id');
        const option = select.options[select.selectedIndex];
        const availableStock = option ? parseInt(option.dataset.available) : 0;
        const currentQuantity = parseInt('{{ $stockOut->Quantity }}');
        const currentProductId = parseInt('{{ $stockOut->Product_Id }}');
        const isSameProduct = option ? parseInt(option.value) === currentProductId : false;

        const totalAvailable = isSameProduct ? availableStock + currentQuantity : availableStock;

        document.getElementById('availableStockDisplay').textContent = totalAvailable;
        document.getElementById('Quantity').max = totalAvailable;

        validateQuantity();
    }

    function validateQuantity() {
        const select = document.getElementById('Product_Id');
        const option = select.options[select.selectedIndex];
        const availableStock = option ? parseInt(option.dataset.available) : 0;
        const currentQuantity = parseInt('{{ $stockOut->Quantity }}');
        const currentProductId = parseInt('{{ $stockOut->Product_Id }}');
        const isSameProduct = option ? parseInt(option.value) === currentProductId : false;
        const totalAvailable = isSameProduct ? availableStock + currentQuantity : availableStock;

        const quantity = parseInt(document.getElementById('Quantity').value) || 0;
        const submitButton = document.getElementById('submitButton');

        if (quantity > totalAvailable) {
            document.getElementById('Quantity').classList.add('is-invalid');
            submitButton.disabled = true;
        } else {
            document.getElementById('Quantity').classList.remove('is-invalid');
            submitButton.disabled = false;
        }
    }

    updateAvailableStock();
</script>
@endsection
