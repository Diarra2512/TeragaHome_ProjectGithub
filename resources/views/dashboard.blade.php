@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f8f5f0;
    }

    .dashboard-welcome h2 {
        color: #51653f;
    }

    .btn-primary, .btn-outline-primary {
        border-radius: 50px;
    }

    .btn-primary {
        background-color: #51653f;
        border-color: #51653f;
    }

    .btn-primary:hover {
        background-color: #405633;
        border-color: #405633;
    }

    .btn-outline-primary {
        color: #51653f;
        border-color: #51653f;
    }

    .btn-outline-primary:hover {
        background-color: #51653f;
        color: white;
    }

    .alert-primary {
        background-color: #e8f0e6;
        color: #3d4b2e;
        border-left: 5px solid #51653f;
    }

    .card {
        border: none;
        background-color: #ffffff;
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        transform: translateY(-5px);
    }

    .card-title {
        font-weight: 600;
        color: #3d4b2e;
    }

    .card .btn {
        font-size: 0.9rem;
    }

    .pagination .page-link {
        color: #51653f;
        border: 1px solid #dee2e6;
    }

    .pagination .page-link:hover,
    .pagination .active .page-link {
        background-color: #51653f;
        border-color: #51653f;
        color: white;
    }
</style>

<div class="container py-5">
    {{-- ENTÊTE --}}
    <div class="d-flex justify-content-between align-items-center mb-4 dashboard-welcome">
        <div>
            <h2 class="fw-bold">Bienvenue {{ Auth::user()->name }} 👋</h2>
            <p class="text-muted mb-0">Gérez vos annonces facilement</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('properties.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Déposer une annonce
            </a>

            <a href="{{ route('dashboard.requests') }}" class="btn btn-outline-primary shadow-sm">
                Demandes reçues 
                <span class="badge bg-primary ms-1">{{ $requestsCount ?? 0 }}</span>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-primary shadow-sm">
                    <i class="bi bi-box-arrow-right"></i> Déconnexion
                </button>
            </form>
        </div>
    </div>

    {{-- MESSAGES FLASH --}}
    @if(session('success'))
        <div class="alert alert-primary">{{ session('success') }}</div>
    @endif

    {{-- ANNONCES --}}
    @if($properties->isEmpty())
        <div class="alert alert-info text-center p-5 rounded bg-light border">
            Vous n’avez encore publié aucune annonce.
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($properties as $property)
                <div class="col">
                    <div class="card h-100 shadow-sm rounded-4">
                        @php $first = $property->images->first(); @endphp
                        <img src="{{ $first ? asset('storage/'.$first->image_path) : asset('images/default-property.jpg') }}"
                             class="card-img-top rounded-top-4" style="height:200px;object-fit:cover;">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $property->title }}</h5>
                            <p class="text-muted mb-1">{{ $property->city }} — {{ ucfirst($property->type) }}</p>
                            <p class="small text-truncate" title="{{ $property->description }}">
                                {{ $property->description }}
                            </p>
                            <p class="fw-bold tex-primary text-end">{{ number_format($property->price,0,',',' ') }} FCFA</p>

                            <div class="mt-auto d-flex gap-2">
                                <a href="{{ route('properties.edit',$property) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-pencil-square"></i> Modifier
                                </a>
                                <form action="{{ route('properties.destroy',$property) }}" method="POST"
                                      onsubmit="return confirm('Supprimer cette annonce ?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $properties->links() }}
        </div>
    @endif
</div>
@endsection
