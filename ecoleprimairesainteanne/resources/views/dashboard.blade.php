@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #141e30, #243b55);
    }

    .section-container {
        display: flex;
        gap: 2rem;
        color: #fff;
    }

    .sidebar {
        width: 220px;
        flex-shrink: 0;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 1rem;
        padding: 1.5rem;
        height: fit-content;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    }

    .sidebar h5 {
        font-size: 1rem;
        text-transform: uppercase;
        margin-bottom: 1rem;
        color: #ffaeae;
    }

    .sidebar a {
        display: block;
        padding: 0.6rem 1rem;
        border-radius: 0.5rem;
        color: #fff;
        text-decoration: none;
        margin-bottom: 0.5rem;
        background: rgba(255, 255, 255, 0.07);
        transition: background 0.3s;
    }

    .sidebar a:hover {
        background: rgba(255, 255, 255, 0.15);
    }

    .content-area {
        flex-grow: 1;
    }

    .section-title {
        font-size: 1.8rem;
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 1.5rem;
    }

    .feature-box {
        background: rgba(255, 255, 255, 0.07);
        border-radius: 1rem;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.05);
    }

    .feature-box h6 {
        font-size: 1.2rem;
        color: #ffaeae;
        margin-bottom: 0.5rem;
    }

    .feature-box p {
        font-size: 0.9rem;
        color: #ddd;
        margin-bottom: 1rem;
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

    .quick-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1rem;
    }

    .stat {
        background: rgba(0, 0, 0, 0.3);
        padding: 1rem;
        border-radius: 0.75rem;
        text-align: center;
    }

    .stat h6 {
        font-size: 0.9rem;
        color: #a5b4fc;
    }

    .stat h3 {
        font-size: 2rem;
        color: #fff;
        margin-top: 0.3rem;
    }

</style>

<div class="section-container">
    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <h5>Navigation</h5>
        <a href="{{ route('stock.in.index') }}"><i class="fas fa-box me-2"></i>Stock In</a>
        <a href="{{ route('stock.out.index') }}"><i class="fas fa-box-open me-2"></i>Stock Out</a>
        <a href="{{ route('categories.index') }}"><i class="fas fa-tags me-2"></i>Categories</a>
        <a href="{{ route('reports.stock.in') }}"><i class="fas fa-chart-bar me-2"></i>Reports</a>
    </div>

    <!-- Main Content -->
    <div class="content-area">
        <div class="section-title">📦 Kitchen Stock Dashboard</div>

        <div class="row">
            <!-- Stock In -->
            <div class="col-md-6">
                <div class="feature-box">
                    <h6><i class="fas fa-box text-pink me-2"></i>Stock In</h6>
                    <p>Log new deliveries or incoming supplies.</p>
                    <a href="{{ route('stock.in.create') }}" class="btn btn-neon btn-sm me-2">
                        <i class="fas fa-plus"></i> Add Entry
                    </a>
                    <a href="{{ route('stock.in.index') }}" class="btn btn-outline-neon btn-sm">
                        <i class="fas fa-list"></i> View All
                    </a>
                </div>
            </div>

            <!-- Stock Out -->
            <div class="col-md-6">
                <div class="feature-box">
                    <h6><i class="fas fa-box-open text-green me-2"></i>Stock Out</h6>
                    <p>Track outgoing food items to departments.</p>
                    <a href="{{ route('stock.out.create') }}" class="btn btn-neon btn-sm me-2">
                        <i class="fas fa-minus"></i> Issue Stock
                    </a>
                    <a href="{{ route('stock.out.index') }}" class="btn btn-outline-neon btn-sm">
                        <i class="fas fa-list"></i> View All
                    </a>
                </div>
            </div>

            <!-- Categories -->
            <div class="col-md-6">
                <div class="feature-box">
                    <h6><i class="fas fa-tags text-warning me-2"></i>Product Categories</h6>
                    <p>Manage the food categories used in your reports.</p>
                    <a href="{{ route('categories.create') }}" class="btn btn-neon btn-sm me-2">
                        <i class="fas fa-plus"></i> New Category
                    </a>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-neon btn-sm">
                        <i class="fas fa-list"></i> View All
                    </a>
                </div>
            </div>

            <!-- Reports -->
            <div class="col-md-6">
                <div class="feature-box">
                    <h6><i class="fas fa-chart-bar text-info me-2"></i>Reports</h6>
                    <p>Download PDF summaries or filter stock movement by date.</p>
                    <a href="{{ route('reports.stock.in') }}" class="btn btn-neon btn-sm me-2">
                        <i class="fas fa-file-import"></i> Stock In Report
                    </a>
                    <a href="{{ route('reports.stock.out') }}" class="btn btn-outline-neon btn-sm">
                        <i class="fas fa-file-export"></i> Stock Out Report
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="mt-4">
            <h6 class="mb-3 text-uppercase text-muted">📊 Today's Stats</h6>
            <div class="quick-stats">
                <div class="stat">
                    <h6>Total Products</h6>
                    <h3>{{ App\Models\Product::count() }}</h3>
                </div>
                <div class="stat">
                    <h6>Categories</h6>
                    <h3>{{ App\Models\Category::count() }}</h3>
                </div>
                <div class="stat">
                    <h6>Stock In Today</h6>
                    <h3>{{ App\Models\StockIn::whereDate('Date', today())->count() }}</h3>
                </div>
                <div class="stat">
                    <h6>Stock Out Today</h6>
                    <h3>{{ App\Models\StockOut::whereDate('Date', today())->count() }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
