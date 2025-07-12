@extends('layouts.app')

@section('content')

<!-- Hero Section avec carrousel de fond -->
<div id="heroCarousel" class="carousel slide carousel-fade w-100 vh-100  position-relative" data-bs-ride="carousel" data-bs-interval="3000">
    <!-- Slides -->
    <div class="carousel-inner w-100 h-100">
        <div class="carousel-item active w-100 h-100 bg-cover" style="background-image: url('/images/appart1.jpg'); background-size: cover; background-position: center;"></div>
        <div class="carousel-item w-100 h-100 bg-cover" style="background-image: url('/images/appart2.jpg'); background-size: cover; background-position: center;"></div>
        <div class="carousel-item w-100 h-100 bg-cover" style="background-image: url('/images/appart3.jpg'); background-size: cover; background-position: center;"></div>
    </div>

    <!-- Contenu texte centré -->
    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center text-white text-center px-4 z-2" style="background-color: rgba(0,0,0,0.4);">
        <div>
            <h1 class="display-4 fw-bold mb-3">Bienvenue sur TerangaHome</h1>
            <p class="lead mb-4">PARCE QU’AU SÉNÉGAL, L’HOSPITALITÉ COMMENCE PAR UN BON TOIT.</p>
            <p>La chaleur d’un chez-soi, partout au Sénégal. <br>
Découvrez notre plateforme dédiée à la location et
l’achat de logements au Sénégal. <br> Recherchez facilement des appartements, maisons,
studios ou villas adaptés à vos besoins. <br>
Grâce à notre interface fluide et à nos annonces vérifiées,
trouvez un logement en toute confiance. <br> Commencez votre recherche maintenant. <br> La Téranga
vous attend
</p>
   
         <!--   <a href="{{ route('properties.index') }}" class="btn btn-lg btn-hero px-4  btn-outline-primary py-2 mt-3 shadow rounded-pill fw-semibold">
                <i class="bi bi-search me-2"></i> Explorer les biens
            </a>  -->
        </div>
    </div>
</div>


         <!-- Formulaire de recherche Modern -->
<section class="bg-white py-4  container position-relative search-section pt-5">
    <div class="">
        <form action="{{ route('properties.index') }}" method="GET" class="row g-3 align-items-end justify-content-center">
            <div class="col-md-3">
                <label class="form-label tex-primary fw-semibold">Ville</label>
                <input type="text" name="city" class="form-control rounded-pill shadow-sm ps-4 border-prim" placeholder="🏙️ Ville (ex: Dakar)">
            </div>
            <div class="col-md-3">
                <label class="form-label tex-primary fw-semibold">Type de bien</label>
                <select name="type" class="form-select rounded-pill shadow-sm ps-4 border-prim">
                    <option value="">🏠 Choisir un type</option>
                    <option value="Maison">Maison</option>
                    <option value="Appartement">Appartement</option>
                    <option value="Terrain">Terrain</option>
                    <option value="Bureau">Bureau</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label tex-primary fw-semibold">Prix max (FCFA)</label>
                <input type="number" name="max_price" class="form-control rounded-pill shadow-sm ps-4 border-prim" placeholder="💰 ex: 30000000">
            </div>
            <div class="col-md-2 d-grid">
               <button type="submit" class="btn btn-primary py-2 fw-semibold rounded-pill">
    <i class="bi bi-filter me-1"></i> Rechercher
</button>
            </div>
        </form>
    </div>
</section>
<!-- Biens en vedette -->
<section class="container my-5 pt-5 pb-5">
    <h2 class="text-center mb-4 fw-bold tex-primary">Biens en vedette</h2>
    <div class="row g-4">
        @foreach ($latestProperties as $property)
            @php
                $firstImage = $property->images->first();
                $imageUrl = $firstImage ? asset('storage/'.$firstImage->image_path) : asset('images/default-property.jpg');
            @endphp
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 hover-shadow rounded-4 position-relative">

                    <!-- Badge contrat -->
                    @if($property->contrat === 'vente')
                        <span class="badge-contract badge-vente">À vendre</span>
                    @elseif($property->contrat === 'location')
                        <span class="badge-contract badge-location">À louer</span>
                    @elseif($property->contrat === 'colocation')
                        <span class="badge-contract badge-colocation">Colocation</span>
                    @endif

                    <img src="{{ $imageUrl }}" class="card-img-top rounded-top-4" style="height:230px; object-fit:cover;" alt="{{ $property->title }}">
                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-prim mb-2">{{ ucfirst($property->type) }}</span>
                        <h5 class="card-title tex-primary fw-bold">{{ $property->title }}</h5>
                        <p class="card-text text-muted small">{{ $property->city }}</p>
                        <p class="card-text flex-grow-1">{{ Str::limit($property->description, 100) }}</p>
                        <a href="{{ route('properties.show', $property) }}" class="btn btn-primary mt-auto rounded-pill">Voir plus</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- Ce que nous offrons -->
<section class="container my-5  arriere">
  <div class="text-center mb-4" data-aos="fade-up">
    <h2 class="section-title text-white">Ce que nous offrons</h2>
    <p class="text-white">Nos services pour faciliter votre projet immobilier</p>
  </div>

  <div class="row g-4 ">
    @foreach([
      ['icon' => 'bi-house-heart', 'title' => 'Biens sélectionnés', 'desc' => 'Chaque bien est vérifié par notre équipe.'],
      ['icon' => 'bi-geo-alt', 'title' => 'Zones couvertes', 'desc' => 'Nous couvrons les grandes villes du Sénégal.'],
      ['icon' => 'bi-cash-coin', 'title' => 'Estimation gratuite', 'desc' => 'Nous estimons la valeur de votre bien.'],
      ['icon' => 'bi-people', 'title' => 'Accompagnement humain', 'desc' => 'Notre équipe vous suit jusqu’à la signature.'],
      ['icon' => 'bi-shield-lock', 'title' => 'Sécurité des données', 'desc' => 'Vos données sont confidentielles et protégées.'],
      ['icon' => 'bi-lightning-charge', 'title' => 'Service réactif', 'desc' => 'Réponse rapide à toutes vos demandes.'],
    ] as $item)
      <div class="col-md-4">
        <div class="flip-card ">
          <div class="flip-card-inner">
            <div class="flip-card-front bg-white d-flex flex-column justify-content-center align-items-center text-center p-4 shadow rounded">
              <i class="bi {{ $item['icon'] }} fs-1 mb-3 tex-primary"></i>
              <h5 class="fw-bold">{{ $item['title'] }}</h5>
            </div>
            <div class="flip-card-back d-flex justify-content-center align-items-center text-center p-4 shadow rounded bg-prim text-white">
              <p class="mb-0">{{ $item['desc'] }}</p>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</section>

<!-- Déposer une annonce -->
<section class=" py-5 container">
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

@endpush
@push('styles')

@endpush
