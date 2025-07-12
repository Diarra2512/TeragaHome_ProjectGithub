@extends('layouts.app')

@section('content')
<div class="container py-5 mt-5">

    <!-- Bouton retour -->
    <a href="{{ route('properties.index') }}" class="btn btn-outline-primary  mb-4">
        ← Retour aux annonces
    </a>

    <!-- Carrousel d’images avec arrière-plan flou -->
    @if ($property->images->count() > 0)
    <div id="carouselPropertyImages" class="carousel slide carousel-fade mb-5 position-relative overflow-hidden rounded shadow" data-bs-ride="carousel" data-bs-interval="3000" style="max-height: 400px;">
        <!-- Image floutée en arrière-plan -->
        <div class="position-absolute top-0 start-0 w-100 h-100" style="z-index: 0; filter: blur(20px); overflow: hidden;">
            <img src="{{ asset('storage/' . $property->images->first()->image_path) }}"
                 class="w-100 h-100 object-fit-cover"
                 style="object-fit: cover;" alt="Background blurred">
        </div>


        <!-- Carousel images au premier plan -->
        <div class="carousel-inner position-relative text-center" style="z-index: 1;">
            @foreach($property->images as $index => $image)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <img src="{{ asset('storage/' . $image->image_path) }}" 
                         class="d-block mx-auto img-fluid rounded"
                         style="max-height: 400px; object-fit: contain;">

                </div>
            @endforeach
        </div>

        @if ($property->images->count() > 1)
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselPropertyImages" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselPropertyImages" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
        @endif
    </div>
    @endif

    <!-- Titre + Prix -->
    <div class="mb-4 text-center">
        <h2 class="fw-bold text-dark">{{ $property->title }}</h2>
        <p class="tex-primary">{{ ucfirst($property->type) }} à {{ $property->city }}</p>
        @if($property->adresse)
            <p class="tex-primary small">📍 Adresse : {{ $property->adresse }}</p>
        @endif
        <h4 class="tex-primary fw-bold">
            {{ number_format($property->price, 0, ',', ' ') }} FCFA
            @if($property->contrat === 'location') /mois @endif
        </h4>
    </div>

    <!-- Résumé infos avec icônes dans des blocs -->
    <div class="row text-center mb-5">
        @if($property->nb_chambres)
        <div class="col-md-3 mb-3">
            <div class="border rounded p-3 bg-white shadow-sm">
                <i class="bi bi-door-closed fs-3 tex-primary"></i><br>
                <strong>{{ $property->nb_chambres }}</strong><br>Chambres
            </div>
        </div>
        @endif

        @if($property->nb_sdb)
        <div class="col-md-3 mb-3">
            <div class="border rounded p-3 bg-white shadow-sm">
                <i class="bi bi-droplet fs-3 tex-primary"></i><br>
                <strong>{{ $property->nb_sdb }}</strong><br>Salles de bain
            </div>
        </div>
        @endif

        @if($property->surface)
        <div class="col-md-3 mb-3">
            <div class="border rounded p-3 bg-white shadow-sm">
                <i class="bi bi-bounding-box fs-3 tex-primary"></i><br>
                <strong>{{ $property->surface }} m²</strong><br>Surface
            </div>
        </div>
        @endif

        @if($property->annee_construction)
        <div class="col-md-3 mb-3">
            <div class="border rounded p-3 bg-white shadow-sm">
                <i class="bi bi-calendar fs-3 tex-primary"></i><br>
                <strong>{{ $property->annee_construction }}</strong><br>Année
            </div>
        </div>
        @endif
    </div>

    <!-- Description -->
    <div class="mb-5 p-4 bg-white rounded shadow-sm">
        <h4 class="tex-primary fw-bold mb-3">Description</h4>
        <p class="text-dark">{{ $property->description }}</p>
    </div>

    <!-- Détails supplémentaires -->
    <div class="mb-5 p-4 bg-white rounded shadow-sm">
        <h5 class="tex-primary fw-bold mb-3">Détails supplémentaires</h5>
        <ul class="list-unstyled">
            <li><strong>Type de contrat :</strong> {{ ucfirst($property->contrat) }}</li>
            @if($property->charges)
                <li><strong>Charges mensuelles :</strong> {{ number_format($property->charges, 0, ',', ' ') }} FCFA</li>
            @endif
            @if($property->caution)
                <li><strong>Caution :</strong> {{ number_format($property->caution, 0, ',', ' ') }} FCFA</li>
            @endif
            <li><strong>Disponibilité :</strong> {{ $property->disponibilite ? 'Disponible' : 'Indisponible' }}</li>
        </ul>
    </div>

    <!-- Équipements -->
    @if (!empty($property->equipements) && is_array($property->equipements))
    <div class="mb-5 p-4 bg-white rounded shadow-sm">
        <h5 class="tex-primary fw-bold mb-3">Caractéristiques</h5>
        <div class="row">
            @foreach ($property->equipements as $equipement)
            <div class="col-md-4 mb-2">
                <i class="bi bi-check-circle tex-primary me-1"></i>
                {{ ucfirst(str_replace('_', ' ', $equipement)) }}
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection
