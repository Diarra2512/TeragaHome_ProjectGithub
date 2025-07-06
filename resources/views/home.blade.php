@extends('layouts.app')

@section('content')

<!-- Hero Image simple -->
<div class="w-100 vh-100 position-relative hero-section">
    <div class="position-absolute top-0 start-0 w-100 h-100 hero-bg"></div>
    <div class="position-relative z-2 h-100 d-flex flex-column justify-content-center align-items-center text-white text-center px-4 hero-content">
        <h1 class="display-4 fw-bold mb-3">Bienvenue sur TerrangaHome</h1>
        <p class="lead mb-4">Trouvez la maison de vos rêves au Sénégal.</p>
        <a href="{{ route('properties.index') }}" class="btn btn-lg btn-hero px-4 py-2 mt-3 shadow rounded-pill fw-semibold">
            <i class="bi bi-search me-2"></i> Explorer les biens
        </a>
    </div>
</div>

<!-- Formulaire de recherche Modern -->
<section class="bg-white py-4 shadow-lg position-relative search-section">
    <div class="container">
        <form action="{{ route('properties.index') }}" method="GET" class="row g-3 align-items-end justify-content-center">
            <div class="col-md-3">
                <label class="form-label text-primary fw-semibold">Ville</label>
                <input type="text" name="city" class="form-control rounded-pill shadow-sm ps-4 border-primary" placeholder="🏙️ Ville (ex: Dakar)">
            </div>
            <div class="col-md-3">
                <label class="form-label text-primary fw-semibold">Type de bien</label>
                <select name="type" class="form-select rounded-pill shadow-sm ps-4 border-primary">
                    <option value="">🏠 Choisir un type</option>
                    <option value="Maison">Maison</option>
                    <option value="Appartement">Appartement</option>
                    <option value="Terrain">Terrain</option>
                    <option value="Bureau">Bureau</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label text-primary fw-semibold">Prix max (FCFA)</label>
                <input type="number" name="max_price" class="form-control rounded-pill shadow-sm ps-4 border-primary" placeholder="💰 ex: 30000000">
            </div>
            <div class="col-md-2 d-grid">
               <button type="submit" class="btn btn-primary py-2 fw-semibold rounded-pill">
    <i class="bi bi-filter me-1"></i> Rechercher
</button>
            </div>
        </form>
    </div>
</section>

<!-- Biens en vedette -->
<section class="container my-5">
    <h2 class="text-center mb-4 fw-bold text-primary">Biens en vedette</h2>
    <div class="row g-4">
        @foreach ($latestProperties as $property)
            @php
                $firstImage = $property->images->first();
                $imageUrl = $firstImage ? asset('storage/'.$firstImage->image_path) : asset('images/default-property.jpg');
            @endphp
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 hover-shadow rounded-4">
                    <img src="{{ $imageUrl }}" class="card-img-top rounded-top-4" style="height:230px; object-fit:cover;" alt="{{ $property->title }}">
                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-primary mb-2">{{ ucfirst($property->type) }}</span>
                        <h5 class="card-title text-primary fw-bold">{{ $property->title }}</h5>
                        <p class="card-text text-muted small">{{ $property->city }}</p>
                        <p class="card-text flex-grow-1">{{ Str::limit($property->description, 100) }}</p>
                        <a href="{{ route('properties.show', $property) }}" class="btn btn-primary mt-auto rounded-pill">Voir plus</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- Déposer une annonce -->
<section class="bg-light py-5">
    <div class="container text-center">
        <i class="bi bi-house-door-fill fs-1 text-primary mb-3"></i>
        <h2 class="fw-bold mb-3 text-primary">Vous êtes propriétaire ?</h2>
        <p class="mb-4 text-secondary">Publiez votre bien immobilier en quelques clics et atteignez un large public partout au Sénégal.</p>
        <a href="{{ route('properties.create') }}" class="btn btn-primary btn-lg shadow px-4 py-2 rounded-pill">
            <i class="bi bi-upload me-2"></i> Déposer une annonce
        </a>
    </div>
</section>

@endsection
@push('styles')
<style>
.hero-section {
    position: relative;
    width: 100%;
    height: 100vh;
    overflow: hidden;
}

.hero-bg {
    background: url('{{ asset('images/hero12.avif') }}') center center / cover no-repeat;
    filter: brightness(0.55);
    position: absolute;
    width: 100%;
    height: 100%;
    z-index: 1;
    transition: transform 20s ease-in-out;
    animation: zoomInOut 20s ease-in-out infinite;
}

@keyframes zoomInOut {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.hero-content {
    position: relative;
    z-index: 2;
    height: 100%;
    display: flex !important;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: white;
    padding: 0 1rem;
    text-shadow: 2px 2px 8px rgba(0,0,0,0.7);
}

.hero-content h1 {
    font-weight: 900;
    letter-spacing: 1.2px;
    margin-bottom: 1rem;
}

.hero-content p.lead {
    font-size: 1.25rem;
    max-width: 600px;
    margin-bottom: 2rem;
    color: #cce4ff;
}

.btn-hero {
    background: #0d6efd;
    color: white !important;
    border: none;
    transition: all 0.3s ease;
    font-size: 1.1rem;
    padding-left: 2rem;
    padding-right: 2rem;
    padding-top: 0.75rem;
    padding-bottom: 0.75rem;
    box-shadow: 0 6px 15px rgba(13, 110, 253, 0.5);
}

.btn-hero:hover {
    background: #0843c9;
    box-shadow: 0 8px 25px rgba(8, 67, 201, 0.7);
    transform: translateY(-3px);
    color: white !important;
}

/* Formulaire recherche */
.search-section .form-label {
    color: #0d6efd;
}

.search-section .form-control,
.search-section .form-select {
    border: 2px solid #0d6efd !important;
    transition: border-color 0.3s ease;
}

.search-section .form-control:focus,
.search-section .form-select:focus {
    border-color: #0843c9 !important;
    box-shadow: 0 0 5px #0843c9;
}

/* Forcer le bleu sur btn-primary partout */
.btn-primary {
    background-color: #0d6efd !important;
    border-color: #0d6efd !important;
    color: white !important;
}

.btn-primary:hover,
.btn-primary:focus {
    background-color: #0843c9 !important;
    border-color: #0843c9 !important;
    color: white !important;
}

/* Pour que les icônes et textes dans btn-primary soient bien blancs */
.btn-primary * {
    color: white !important;
}

.text-primary {
    color: #0d6efd !important;
}

.text-secondary {
    color: #6c757d !important;
}

/* Cards hover */
.hover-shadow:hover {
    box-shadow: 0 10px 20px rgba(13, 110, 253, 0.3) !important;
    transform: translateY(-5px);
    transition: all 0.3s ease-in-out;
}
</style>
@endpush
