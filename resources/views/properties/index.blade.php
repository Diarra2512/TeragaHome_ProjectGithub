@extends('layouts.app')

@section('content')
<div class="container mt-5 py-5">
    <h1 class="mb-4 text-center fw-bold text-primary">Biens disponibles</h1>

    <!-- Filtres -->
    <form action="{{ route('properties.index') }}" method="GET" class="row g-3 mb-5 justify-content-center">
        <div class="col-md-3">
            <input type="text" name="city" class="form-control shadow-sm" placeholder="Ville (ex: Dakar)"
                   value="{{ $filters['city'] ?? '' }}">
        </div>
        <div class="col-md-3">
            <select name="type" class="form-select shadow-sm">
                <option value="">Type de bien</option>
                <option value="villa" {{ ($filters['type'] ?? '') === 'villa' ? 'selected' : '' }}>Villa</option>
                <option value="appartement" {{ ($filters['type'] ?? '') === 'appartement' ? 'selected' : '' }}>Appartement</option>
                <option value="terrain" {{ ($filters['type'] ?? '') === 'terrain' ? 'selected' : '' }}>Terrain</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="number" name="price_max" class="form-control shadow-sm" placeholder="Prix max (FCFA)"
                   value="{{ $filters['price_max'] ?? '' }}">
        </div>
        <div class="col-md-2 d-grid">
            <button class="btn btn-primary fw-semibold">Filtrer</button>
        </div>
    </form>

    <!-- Résultats -->
    <div class="row g-4">
        @forelse ($properties as $property)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    @php
                        $first = $property->images->first();
                    @endphp

                    <img src="{{ $first ? asset('storage/' . $first->image_path) : asset('images/default-property.jpg') }}"
                         class="card-img-top"
                         style="height: 200px; object-fit: cover;"
                         alt="Image du bien">

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold text-primary">{{ $property['title'] }}</h5>
                        <p class="text-muted mb-1">{{ $property['city'] }} – {{ ucfirst($property['type']) }}</p>
                        <p class="mb-2 small">{{ Str::limit($property['description'], 90) }}</p>
                        <p class="fw-semibold text-primary mb-3">{{ number_format($property['price'], 0, ',', ' ') }} FCFA</p>
                        <a href="{{ route('properties.show', $property['id']) }}" class="btn btn-outline-primary btn-sm mt-auto">Voir plus</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center shadow-sm">Aucun bien ne correspond à votre recherche.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Forcer le bleu sur les boutons */
    .btn-primary,
    .btn-primary:hover,
    .btn-outline-primary {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        color: white !important;
    }

    .btn-outline-primary {
        background-color: transparent !important;
        color: #0d6efd !important;
    }

    .btn-outline-primary:hover {
        background-color: #0d6efd !important;
        color: white !important;
    }

    /* Forcer le texte bleu */
    .text-primary {
        color: #0d6efd !important;
    }
</style>
@endpush
