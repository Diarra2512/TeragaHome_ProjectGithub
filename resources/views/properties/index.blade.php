@extends('layouts.app')

@section('content')
<div class="container mt-5 py-5">
    <h1 class="mb-4 text-center fw-bold text-primary">Biens disponibles</h1>

    <!-- Filtres -->
    <form action="{{ route('properties.index') }}" method="GET" class="row g-3 mb-5 justify-content-center">
        <div class="col-md-3">
            <input type="text" name="city" class="form-control shadow-sm"
                   placeholder="Ville (ex: Dakar)"
                   value="{{ $filters['city'] ?? '' }}">
        </div>
        <div class="col-md-3">
            <select name="type" class="form-select shadow-sm">
                <option value="">Type de bien</option>
                <option value="villa"        {{ ($filters['type'] ?? '') === 'villa' ? 'selected' : '' }}>Villa</option>
                <option value="appartement"  {{ ($filters['type'] ?? '') === 'appartement' ? 'selected' : '' }}>Appartement</option>
                <option value="terrain"      {{ ($filters['type'] ?? '') === 'terrain' ? 'selected' : '' }}>Terrain</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="number" name="price_max" class="form-control shadow-sm"
                   placeholder="Prix max (FCFA)"
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
                    @php $first = $property->images->first(); @endphp

                    <img src="{{ $first ? asset('storage/'.$first->image_path) : asset('images/default-property.jpg') }}"
                         class="card-img-top"
                         style="height:200px; object-fit:cover;"
                         alt="Image du bien">

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold text-primary">{{ $property->title }}</h5>
                        <p class="text-muted mb-1">
                            {{ $property->city }} – {{ ucfirst($property->type) }}
                        </p>
                        <p class="mb-2 small">
                            {{ Str::limit($property->description, 90) }}
                        </p>
                        <p class="fw-semibold text-primary mb-3">
                            {{ number_format($property->price, 0, ',', ' ') }} FCFA
                        </p>

                        <!-- Boutons + favoris -->
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <div class="d-flex gap-2">
                                <a href="{{ route('properties.show', $property) }}" class="btn btn-outline-primary btn-sm">Voir plus</a>
                                <a href="{{ route('properties.contact', $property) }}" class="btn btn-primary btn-sm text-white">Nous contacter</a>
                            </div>
                            <button class="btn btn-sm favorite-btn" data-id="{{ $property->id }}">
                                <i class="bi bi-heart fs-5"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center shadow-sm">
                    Aucun bien ne correspond à votre recherche.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection

@push('styles')
<!-- Inclure Bootstrap Icons si pas déjà fait -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<style>
.favorite-btn {
    border: none;
    background: transparent;
    padding: 0;
    cursor: pointer;
}
.favorite-btn .bi-heart-fill {
    color: red;
}
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.favorite-btn');
        let favorites = JSON.parse(localStorage.getItem('favorites') || '[]');

        buttons.forEach(btn => {
            const id = btn.dataset.id;
            const icon = btn.querySelector('i');

            if (favorites.includes(id)) {
                icon.classList.remove('bi-heart');
                icon.classList.add('bi-heart-fill');
            }

            btn.addEventListener('click', function () {
                let favs = JSON.parse(localStorage.getItem('favorites') || '[]');

                if (favs.includes(id)) {
                    favs = favs.filter(f => f !== id);
                    icon.classList.remove('bi-heart-fill');
                    icon.classList.add('bi-heart');
                } else {
                    favs.push(id);
                    icon.classList.remove('bi-heart');
                    icon.classList.add('bi-heart-fill');
                }

                localStorage.setItem('favorites', JSON.stringify(favs));
            });
        });
    });
</script>
@endpush
