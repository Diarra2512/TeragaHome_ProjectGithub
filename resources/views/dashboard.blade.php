@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- ENTÊTE --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold tex-primary">Bienvenue {{ Auth::user()->name }} 👋</h2>
            <p class="text-muted mb-0">Gérez vos annonces</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('properties.create') }}" class="btn btn-primary rounded-pill text-white shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Déposer une annonce
            </a>

            <a href="{{ route('dashboard.requests') }}" class="btn btn-outline-primary rounded-pill shadow-sm">
                Demandes reçues 
                <span class="badge bg-primary ms-1">{{ $requestsCount ?? 0 }}</span>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-primary rounded-pill shadow-sm">
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
        <div class="alert alert-info text-center p-5 rounded">
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
                            <p class="fw-bold tex-primary">{{ number_format($property->price,0,',',' ') }} FCFA</p>

                            <div class="mt-auto d-flex gap-2">
                                <a href="{{ route('properties.edit',$property) }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil-square"></i> Modifier
                                </a>
                                <form action="{{ route('properties.destroy',$property) }}" method="POST"
                                      onsubmit="return confirm('Supprimer cette annonce ?')">
                                    @csrf @method('DELETE')
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

        <div class="mt-4">
            {{ $properties->links() }}
        </div>
    @endif
</div>
@endsection
