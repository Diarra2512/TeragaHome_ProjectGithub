@extends('layouts.admin')

@section('content')
<style>
    body {
        background-color: #f5f5dc;
    }

    .container h2 {
        color: #51653f;
        font-weight: bold;
    }

    .card.property-card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 15px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        padding: 30px;
        color: #333;
    }

    .card.property-card h4 {
        color: #51653f;
        font-weight: bold;
    }

    .card.property-card p {
        margin-bottom: 0.8rem;
        font-size: 16px;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }
</style>

<div class="container py-4">
    <h2 class="mb-4">Détails de l'annonce</h2>

    <div class="card property-card">
        <h4>{{ $property->title }}</h4>
        <p><strong>Description :</strong> {{ $property->description }}</p>
        <p><strong>Prix :</strong> {{ number_format($property->price, 0, ',', ' ') }} FCFA</p>
        <p><strong>Localisation :</strong> {{ $property->location }}</p>
        <p><strong>Créée le :</strong> {{ $property->created_at->format('d/m/Y') }}</p>
    </div>

    <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary mt-4">
        <i class="bi bi-arrow-left"></i> Retour à la liste
    </a>
</div>
@endsection
