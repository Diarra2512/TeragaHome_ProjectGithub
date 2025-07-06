@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Titre -->
    <div class="text-center mb-5">
        <h1 class="fw-bold text-primary">À propos de <span class="text-dark">TerrangaHome</span></h1>
        <p class="lead text-muted mt-3">
            Votre partenaire immobilier de confiance au Sénégal.
        </p>
    </div>

    <!-- Intro -->
    <div class="row align-items-center mb-5">
        <div class="col-md-6 mb-4 mb-md-0">
            <img src="{{ asset('images/equipe.') }}" alt="Notre équipe" class="img-fluid rounded shadow-sm">
        </div>
        <div class="col-md-6">
            <p class="fs-5">
                <strong>TerrangaHome</strong> est une agence immobilière digitale basée au Sénégal,
                spécialisée dans la <span class="text-primary fw-semibold">vente</span>, la <span class="text-primary fw-semibold">location</span> et la <span class="text-primary fw-semibold">gestion de biens immobiliers</span>.
            </p>
            <p>
                Nous accompagnons nos clients de la recherche à la signature, avec transparence et professionnalisme. Notre plateforme rend l'immobilier accessible à tous, partout au Sénégal.
            </p>
        </div>
    </div>

    <!-- Avantages -->
    <div class="mb-5">
        <h3 class="fw-bold text-primary mb-3">Pourquoi choisir TerrangaHome ?</h3>
        <div class="row">
            @php
                $avantages = [
                    ['✔️', 'Large choix de biens immobiliers'],
                    ['📞', 'Accompagnement personnalisé et conseils'],
                    ['🔒', 'Plateforme intuitive et sécurisée'],
                    ['🌍', 'Bonne connaissance du marché sénégalais']
                ];
            @endphp

            @foreach ($avantages as $avantage)
                <div class="col-md-6 mb-3 d-flex">
                    <span class="fs-4 me-3">{{ $avantage[0] }}</span>
                    <p class="mb-0 align-self-center">{{ $avantage[1] }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Équipe -->
    <div class="mb-5">
        <h3 class="fw-bold text-primary mb-4">Notre équipe</h3>
        <div class="row">
            @php
                $equipe = [
                    ['nom' => 'Mamadou Ba', 'poste' => 'Fondateur & CEO', 'photo' => 'https://randomuser.me/api/portraits/men/45.jpg'],
                    ['nom' => 'Fatou Sow', 'poste' => 'Responsable commerciale', 'photo' => 'https://randomuser.me/api/portraits/women/65.jpg'],
                    ['nom' => 'Aliou Diop', 'poste' => 'Expert immobilier', 'photo' => 'https://randomuser.me/api/portraits/men/28.jpg']
                ];
            @endphp

            @foreach ($equipe as $membre)
                <div class="col-md-4 text-center mb-4">
                    <img src="{{ $membre['photo'] }}" alt="{{ $membre['nom'] }}" class="rounded-circle shadow-sm mb-2" width="100" height="100">
                    <h5 class="fw-bold mb-0">{{ $membre['nom'] }}</h5>
                    <small class="text-muted">{{ $membre['poste'] }}</small>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Call to Action -->
    <div class="text-center">
        <h4 class="mb-3">Prêt à trouver ou publier un bien ?</h4>
        <a href="{{ route('properties.index') }}" class="btn btn-primary btn-lg shadow-sm">Explorer les biens</a>
    </div>
</div>
@endsection
