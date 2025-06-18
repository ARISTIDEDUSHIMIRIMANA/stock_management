<footer class="mt-auto py-4 bg-dark text-light">
    <div class="container">
        <div class="row g-4">
            <!-- School Information -->
            <div class="col-md-4">
                <h5 class="mb-3">Ecole Primaire Sainte Anne</h5>
                <p class="mb-1">Providing quality education and efficient management systems.</p>
                <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i>School Location</p>
                <p class="mb-0"><i class="fas fa-phone me-2"></i>Contact Number</p>
            </div>

            <!-- Quick Links -->
            <div class="col-md-4">
                <h5 class="mb-3">Quick Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('welcome') }}" class="text-light text-decoration-none">
                            <i class="fas fa-home me-2"></i>Home
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('dashboard') }}" class="text-light text-decoration-none">
                            <i class="fas fa-chart-line me-2"></i>Dashboard
                        </a>
                    </li>
                </ul>
            </div>

            <!-- System Info -->
            <div class="col-md-4">
                <h5 class="mb-3">System Information</h5>
                <p class="mb-1">Stock Management System</p>
                <p class="mb-1">Version 1.0</p>
                <p class="mb-0 mt-3">© {{ date('Y') }} All rights reserved.</p>
            </div>
        </div>
    </div>
</footer> 