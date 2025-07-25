@extends('layouts.app')

@section('content')
<div class="container mt-5 py-5">
    <h1 class="mb-4 text-center fw-bold tex-primary">Biens disponibles</h1>

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
            <button class="btn btn-primary fw-semibold">Rechercher</button>
        </div>
    </form>

    <!-- Résultats -->
    <div class="row g-4">
        @forelse ($properties as $property)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 position-relative">
                    @php $first = $property->images->first(); @endphp

                    <!-- Badge contrat -->
                    @if($property->contrat === 'vente')
                        <span class="badge-contract badge-vente">À vendre</span>
                    @elseif($property->contrat === 'location')
                        <span class="badge-contract badge-location">À louer</span>
                    @elseif($property->contrat === 'colocation')
                        <span class="badge-contract badge-colocation">Colocation</span>
                    @endif

                    <img src="{{ $first ? asset('storage/'.$first->image_path) : asset('images/default-property.jpg') }}"
                         class="card-img-top"
                         style="height:200px; object-fit:cover;"
                         alt="Image du bien">

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold tex-primary">{{ $property->title }}</h5>
                        <p class="text-muted mb-1">
                            {{ $property->city }} – {{ ucfirst($property->type) }}
                        </p>
                        <p class="mb-2 small">
                            {{ Str::limit($property->description, 90) }}
                        </p>
                        <p class="fw-semibold tex-primary mb-3">
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

<!-- Déposer une annonce -->
<section class="bg-light py-5 container">
    <div class="container text-center">
        <i class="bi bi-house-door-fill fs-1 tex-primary mb-3"></i>
        <h2 class="fw-bold mb-3 tex-primary">Vous êtes propriétaire ?</h2>
        <p class="mb-4 text-secondary">Publiez votre bien immobilier en quelques clics et atteignez un large public partout au Sénégal.</p>
        <a href="{{ route('properties.create') }}" class="btn btn-primary btn-lg shadow px-4 py-2 rounded-pill">
            <i class="bi bi-upload me-2"></i> Déposer une annonce
        </a>
    </div>   
</section>
@endsection

@push('styles')
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
/* Badge positionné en haut à droite de l'image */
.badge-contract {
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 0.25em 0.6em;
    font-size: 0.75rem;
    font-weight: 600;
    border-radius: 0.25rem;
    color: white;
    z-index: 10;
    text-transform: uppercase;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
}

/* Couleurs selon type de contrat */
.badge-vente {
    background-color: #28a745; /* vert */
}

.badge-location {
    background-color: #007bff; /* bleu */
}

.badge-colocation {
    background-color: #17a2b8; /* cyan */
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    let favoris = JSON.parse(localStorage.getItem("favorites") || "[]");

    document.querySelectorAll(".favorite-btn").forEach(function (btn) {
        const id = parseInt(btn.dataset.id);
        const icon = btn.querySelector("i");

        if (favoris.includes(id)) {
            btn.classList.add("active");
            icon.classList.remove("bi-heart");
            icon.classList.add("bi-heart-fill");
        }

        btn.addEventListener("click", function () {
            const index = favoris.indexOf(id);

            if (index !== -1) {
                favoris.splice(index, 1);
                btn.classList.remove("active");
                icon.classList.remove("bi-heart-fill");
                icon.classList.add("bi-heart");
            } else {
                favoris.push(id);
                btn.classList.add("active");
                icon.classList.remove("bi-heart");
                icon.classList.add("bi-heart-fill");
            }

            localStorage.setItem("favorites", JSON.stringify(favoris));
        });
    });
});
</script>
@endpush
