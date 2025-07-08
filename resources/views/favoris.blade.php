@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold text-primary mb-4">❤️ Mes favoris</h2>

   

    {{-- Bloc Laravel si déjà chargés avec ?ids= --}}
    @if(isset($favorites) && count($favorites))
        <div class="row g-4 mt-4">
            @foreach($favorites as $p)
                <div class="col-md-4">
                    <div class="card shadow-sm h-100">
                        <img src="{{ $p->images->first() ? asset('storage/'.$p->images->first()->image_path) : asset('images/default-property.jpg') }}"
                             class="card-img-top" style="height:200px; object-fit:cover;">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $p->title }}</h5>
                            <p class="text-muted">{{ $p->city }} – {{ $p->type }}</p>
                            <p>{{ Str::limit($p->description, 90) }}</p>
                            <p class="fw-bold text-primary">{{ number_format($p->price, 0, ',', ' ') }} FCFA</p>
                            <a href="{{ route('properties.show', $p->id) }}" class="btn btn-sm btn-outline-primary">Voir</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif(isset($favorites))
        <div class="alert alert-info">Aucun bien trouvé.</div>
    @endif
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const favs = JSON.parse(localStorage.getItem('favorites') || '[]');

    if (favs.length === 0) {
        document.getElementById('favorites-container').innerHTML =
            '<div class="alert alert-info">Aucun bien ajouté en favori.</div>';
        return;
    }

    const params = new URLSearchParams(window.location.search);
    if (!params.has('ids')) {
        const newUrl = `${window.location.pathname}?ids=${favs.join(',')}`;
        window.location.href = newUrl;
    }
});
</script>
@endpush
