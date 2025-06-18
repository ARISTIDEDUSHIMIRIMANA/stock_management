@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="container-fluid py-5" style="background-color: #1e1e2f; min-height: 90vh;">
    <div class="row align-items-center text-white">
        <div class="col-lg-6 px-5 text-center text-lg-start">
            <h1 class="display-4 fw-bold mb-4" style="color: #fbbf24;">Ecole Primaire Sainte Anne</h1>
            <p class="fs-5 mb-4" style="color: #e0e0e0;">Un système de gestion des stocks pour la cuisine scolaire, moderne et efficace.</p>

            @guest
                <div class="mt-4 d-flex flex-wrap justify-content-center justify-content-lg-start gap-3">
                    <a href="{{ route('login') }}" class="btn px-4 py-2 fs-5" style="background-color: #f43f5e; color: white; border-radius: 0.5rem;">
                        <i class="fas fa-sign-in-alt me-2"></i>Connexion
                    </a>
                    <a href="{{ route('register') }}" class="btn px-4 py-2 fs-5" style="background-color: transparent; border: 2px solid #f43f5e; color: #f43f5e; border-radius: 0.5rem;">
                        <i class="fas fa-user-plus me-2"></i>Inscription
                    </a>
                </div>
            @else
                <div class="mt-4">
                    <a href="{{ route('dashboard') }}" class="btn px-4 py-2 fs-5" style="background-color: #14b8a6; color: white; border-radius: 0.5rem;">
                        <i class="fas fa-tachometer-alt me-2"></i>Tableau de Bord
                    </a>
                </div>
            @endguest
        </div>

        <div class="col-lg-6 text-center mt-4 mt-lg-0">
            <img src="{{ asset('images/kitchen_stock_dark.svg') }}" alt="Illustration" class="img-fluid" style="max-height: 360px;">
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="text-white h-100 p-4 rounded shadow" style="background-color: #2a2a40;">
                <div class="mb-3">
                    <i class="fas fa-box fa-2x" style="color: #fbbf24;"></i>
                </div>
                <h4 class="fw-bold">Gestion de Stock</h4>
                <p style="color: #cccccc;">Suivi des produits, entrées et sorties avec précision.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-white h-100 p-4 rounded shadow" style="background-color: #2a2a40;">
                <div class="mb-3">
                    <i class="fas fa-sync-alt fa-2x" style="color: #14b8a6;"></i>
                </div>
                <h4 class="fw-bold">Suivi des Mouvements</h4>
                <p style="color: #cccccc;">Historique complet de tous les mouvements du stock.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-white h-100 p-4 rounded shadow" style="background-color: #2a2a40;">
                <div class="mb-3">
                    <i class="fas fa-file-signature fa-2x" style="color: #f43f5e;"></i>
                </div>
                <h4 class="fw-bold">Rapports Dynamiques</h4>
                <p style="color: #cccccc;">Générez des rapports professionnels et faciles à lire.</p>
            </div>
        </div>
    </div>
</div>
@endsection
