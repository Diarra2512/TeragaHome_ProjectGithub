@extends('layouts.app')

@section('content')
<div class="container py-5">

    <!-- Bouton retour -->
    <a href="{{ route('properties.index') }}" class="btn btn-outline-primary mb-4">
        ← Retour aux annonces
    </a>

    <div class="row">
        <!-- Image principale -->
        <div class="col-md-6">
            @php $first = $property->images->first(); @endphp
            <img src="{{ $first ? asset('storage/' . $first->image_path) : asset('images/default-property.jpg') }}"
                 alt="Image du bien"
                 class="img-fluid rounded shadow-sm w-100 mb-4"
                 style="max-height:400px; object-fit:cover;">
        </div>

        <!-- Infos bien -->
        <div class="col-md-6">
            <h2 class="fw-bold tex-primary">{{ $property->title }}</h2>
            <p class="text-dark mb-1">{{ ucfirst($property->type) }} à {{ $property->city }}</p>
            @if($property->adresse)
                <p class="text-dark small">📍 Adresse : {{ $property->adresse }}</p>
            @endif
            <h4 class="text-primary fw-bold mb-3">
                {{ number_format($property->price, 0, ',', ' ') }} FCFA
            </h4>

            <ul class="list-unstyled text-dark">
                @if($property->contrat) <li><strong>Type de contrat :</strong> {{ ucfirst($property->contrat) }}</li> @endif
                @if($property->surface) <li><strong>Surface :</strong> {{ $property->surface }} m²</li> @endif
                @if($property->nb_pieces) <li><strong>Pièces :</strong> {{ $property->nb_pieces }}</li> @endif
                @if($property->nb_chambres) <li><strong>Chambres :</strong> {{ $property->nb_chambres }}</li> @endif
                @if($property->nb_sdb) <li><strong>Salles de bain :</strong> {{ $property->nb_sdb }}</li> @endif
                @if($property->etage) <li><strong>Étage :</strong> {{ $property->etage }}</li> @endif
                @if($property->annee_construction) <li><strong>Année de construction :</strong> {{ $property->annee_construction }}</li> @endif
                @if($property->charges) <li><strong>Charges :</strong> {{ number_format($property->charges, 0, ',', ' ') }} FCFA</li> @endif
                @if($property->caution) <li><strong>Caution :</strong> {{ number_format($property->caution, 0, ',', ' ') }} FCFA</li> @endif
                <li><strong>Disponibilité :</strong> {{ $property->disponibilite ? 'Disponible' : 'Indisponible' }}</li>
            </ul>

            <!-- Description -->
            <div class="mt-4">
                <h5 class="text-primary">Description</h5>
                <p class="text-dark">{{ $property->description }}</p>
            </div>

            <!-- Équipements -->
            @if (!empty($property->equipements) && is_array($property->equipements))
                <div class="mt-3">
                    <h6 class="text-primary">Commodités</h6>
                    <ul class="list-inline">
                        @foreach ($property->equipements as $e)
                            <li class="list-inline-item badge bg-primary-subtle tex-primary border border-primary me-1 mb-1">
                                {{ ucfirst(str_replace('_', ' ', $e)) }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

    <!-- Galerie d’images -->
    @if ($property->images->count() > 1)
        <h5 class="mt-5 mb-3 fw-semibold tex-primary">Autres images</h5>
        <div class="row row-cols-2 row-cols-md-4 g-3">
            @foreach($property->images->slice(1) as $image)
                <div class="col">
                    <img src="{{ asset('storage/' . $image->image_path) }}"
                         class="img-fluid rounded shadow-sm"
                         style="object-fit:cover; height: 150px; width: 100%;">
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection

@push('styles')

@endpush
