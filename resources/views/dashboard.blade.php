@extends('layouts.app')

@section('content')
<div class="container py-5">

    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary">Bienvenue {{ Auth::user()->name }} 👋</h2>
            <p class="text-muted">Voici vos annonces immobilières publiées</p>
        </div>

        <div class="d-flex gap-2">
            <!-- Bouton Déposer -->
            <a href="{{ route('properties.create') }}" class="btn btn-primary shadow-sm rounded-pill text-white">
                <i class="bi bi-plus-circle me-1"></i> Déposer une annonce
            </a>

            <!-- Bouton Déconnexion -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-primary shadow-sm rounded-pill">
                    <i class="bi bi-box-arrow-right"></i> Déconnexion
                </button>
            </form>
        </div>
    </div>

    <!-- Message succès -->
    @if(session('success'))
        <div class="alert alert-primary">{{ session('success') }}</div>
    @endif

    <!-- Annonces -->
    @if($properties->isEmpty())
        <div class="alert alert-info text-center p-5 rounded">
            Vous n’avez encore publié aucune annonce.
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($properties as $property)
                <div class="col">
                    <div class="card h-100 shadow-sm rounded-4">
                        @php $firstImage = $property->images->first(); @endphp
                        <img src="{{ $firstImage ? asset('storage/'.$firstImage->image_path) : asset('images/default-property.jpg') }}"
                             class="card-img-top rounded-top-4" style="height:200px; object-fit:cover;">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $property->title }}</h5>
                            <p class="text-muted mb-1">{{ $property->city }} – {{ ucfirst($property->type) }}</p>
                            <p class="small text-truncate" title="{{ $property->description }}">{{ $property->description }}</p>
                            <p class="fw-bold text-primary">{{ number_format($property->price, 0, ',', ' ') }} FCFA</p>

                            <div class="mt-auto d-flex gap-2">
                                <!-- Modifier : Vert -->
                                <a href="{{ route('properties.edit', $property) }}" class="btn btn-success btn-sm">
                                    <i class="bi bi-pencil-square"></i> Modifier
                                </a>

                                <!-- Supprimer : Rouge -->
                                <form action="{{ route('properties.destroy', $property) }}" method="POST"
                                      onsubmit="return confirm('Supprimer cette annonce ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-trash"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $properties->links() }}
        </div>
    @endif

</div>
@endsection

@push('styles')
<style>
    /* Bouton principal bleu avec texte blanc */
    .btn-primary {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        color: white !important;
    }
    .btn-primary:hover {
        background-color: #0843c9 !important;
        border-color: #0843c9 !important;
    }

    /* Bouton modifier en vert */
    .btn-success {
        background-color: #198754 !important;
        border-color: #198754 !important;
        color: white !important;
    }
    .btn-success:hover {
        background-color: #146c43 !important;
        border-color: #146c43 !important;
    }

    /* Bouton déconnexion */
    .btn-outline-primary {
        color: #0d6efd !important;
        border-color: #0d6efd !important;
    }
    .btn-outline-primary:hover {
        background-color: #0d6efd !important;
        color: white !important;
    }

    /* Texte normal en noir (défaut Bootstrap) */

    /* Prix en bleu */
    .text-primary {
        color: #0d6efd !important;
    }

    /* Alertes info en bleu clair */
    .alert-info {
        background-color: #cfe2ff !important;
        color: #0d6efd !important;
        border-color: #b6d4fe !important;
    }
</style>
@endpush
