@extends('layouts.app') {{-- adapte selon ton layout principal --}}

@section('content')
<section class="container py-5 mt-5">
  <div class="text-center mb-5" data-aos="fade-down">
    <h1 class="section-title">À propos de TerrangaHome</h1>
    <p class="text-muted">L'immobilier en toute confiance au Sénégal</p>
  </div>

  <div class="row align-items-center mb-5">
    <div class="col-md-6" data-aos="fade-right">
      <img src="{{ asset('images/equipe.jpg') }}" alt="Notre équipe" class="img-fluid rounded shadow">
    </div>
    <div class="col-md-6" data-aos="fade-left">
      <h2 class="h4">Qui sommes nous ?</h2>
      <p>
 TerrangaHome c'est le portail immobilier de ceux qui veulent changer de cadre de vie. 
Que vous rêviez de poser vos valises à l'étranger ou à l'autre bout du pays, 
d'une maison pour un nouveau quotidien ou d'un pied à terre pour des parenthèses en famille et entre amis. 
Green acres vous aide à trouver votre nouvelle vie. </p>
      <p>
        Notre équipe est composée de professionnels passionnés par l'immobilier, le design et le développement web. 
        Nous mettons notre expertise au service de nos clients pour leur offrir une expérience unique et personnalisée.
      </p>
      <p>
        Chez TerrangaHome, nous croyons en la transparence, la confiance et l'innovation. 
        Notre mission est de faciliter la recherche immobilière pour tous, en mettant à disposition des outils modernes et efficaces.
      </p>
      <p>
        Nous sommes là pour vous accompagner à chaque étape de votre projet immobilier, que ce soit pour acheter, vendre ou louer un bien. 
        Notre objectif est de vous offrir un service fiable, transparent et humain, afin que vous puissiez réaliser vos rêves immobiliers en toute sérénité.
      </p>
      <p>
        Rejoignez-nous dans cette aventure et découvrez comment TerrangaHome peut transformer votre expérience immobilière au Sénégal.
      </p>
      <p>
        Vous souhaitez publier votre bien sur notre site et bénéficier d'une visibilité internationale exceptionnelle ?
      </p>
      <p>
        
        <a href="{{ route('properties.create') }}" class="btn btn-primary">Déposer une annonce</a>

      </p>

    </div>
  </div>

  <div class="row text-center mb-5 pt-5 pb-5 " >
    <div class="col-md-4" data-aos="zoom-in">
      <div class="about-box">
        <i class="bi bi-house-door about-icon"></i>
        <h3 class="h5 mt-3">Notre Mission</h3>
        <p>Faciliter la recherche immobilière pour tous, avec transparence et efficacité.</p>
      </div>
    </div>
    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
      <div class="about-box">
        <i class="bi bi-shield-check about-icon"></i>
        <h3 class="h5 mt-3">Nos Valeurs</h3>
        <p>Engagement, confiance, innovation et service humain.</p>
      </div>
    </div>
    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
      <div class="about-box">
        <i class="bi bi-people about-icon"></i>
        <h3 class="h5 mt-3">Notre Équipe</h3>
        <p>Des experts de l'immobilier, du design et du développement web réunis pour vous servir.</p>
      </div>
    </div>
  </div>


  <section class="container my-5 pt-5 pb-5" >
  <div class="text-center mb-4" data-aos="fade-up">
    <h2 class="section-title">Nos Engagements</h2>
    <p class="text-muted">TerrangaHome s'engage à offrir un service fiable, transparent et humain à chaque étape de votre projet immobilier.</p>
  </div>

  <div class="row g-4">
    <div class="col-md-4" data-aos="zoom-in">
      <div class="card h-100 shadow border-0">
        <div class="card-body text-center">
          <i class="bi bi-shield-lock fs-1 text-primary mb-3"></i>
          <h5 class="card-title">Sécurité</h5>
          <p class="card-text">Tous les biens publiés sont vérifiés et validés pour vous garantir des transactions sécurisées.</p>
        </div>
      </div>
    </div>

    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
      <div class="card h-100 shadow border-0">
        <div class="card-body text-center">
          <i class="bi bi-lightning-charge fs-1 text-warning mb-3"></i>
          <h5 class="card-title">Réactivité</h5>
          <p class="card-text">Notre équipe vous répond sous 24h et vous accompagne à chaque étape de votre démarche.</p>
        </div>
      </div>
    </div>

    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
      <div class="card h-100 shadow border-0">
        <div class="card-body text-center">
          <i class="bi bi-eye fs-1 text-success mb-3"></i>
          <h5 class="card-title">Transparence</h5>
          <p class="card-text">Nous fournissons toutes les informations nécessaires pour une décision éclairée, sans surprise.</p>
        </div>
      </div>
    </div>
  </div>
</section>



  <div id="teamCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
  <div class="carousel-inner">

    {{-- Slide 1 --}}
    <div class="carousel-item active">
      <div class="d-flex align-items-center gap-4 p-4">
        <div class="col-md-4 text-center">
          <img src="{{ asset('images/souley.jpg') }}" alt="Souley" class="img-fluid rounded-circle shadow" style="max-width: 200px;">
        </div>
        <div class="col-md-8">
          <h4>Souleymane MADIKO</h4>
          <p class="text-muted">Fondateur & CEO - Expert en stratégie immobilière et digitalisation des services.</p>
        </div>
      </div>
    </div>

    {{-- Slide 2 --}}
    <div class="carousel-item">
      <div class="d-flex align-items-center gap-4 p-4">
        <div class="col-md-4 text-center">
          <img src="{{ asset('images/ndeye.jpg') }}" alt="Ndeye" class="img-fluid rounded-circle shadow" style="max-width: 200px;">
        </div>
        <div class="col-md-8">
          <h4>Ndeye MBINGUE</h4>
          <p class="text-muted">Développeuse Frontend - Passionnée par les interfaces intuitives et l’expérience utilisateur.</p>
        </div>
      </div>
    </div>

    {{-- Slide 3 --}}
    <div class="carousel-item">
      <div class="d-flex align-items-center gap-4 p-4">
        <div class="col-md-4 text-center">
          <img src="{{ asset('images/diarra.jpg') }}" alt="Diarra" class="img-fluid rounded-circle shadow" style="max-width: 200px;">
        </div>
        <div class="col-md-8">
          <h4>Sokhna Diarra Bousso NDIAYE</h4>
          <p class="text-muted">Développeur Backend - Responsable de l’architecture et de la sécurité des données.</p>
        </div>
      </div>
    </div>

  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#teamCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#teamCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>


  <div class="cta-box text-center" data-aos="fade-up">
    <h4><span id="client-counter">0</span> clients accompagnés avec succès</h4>
    <p>Vous souhaitez acheter, vendre ou louer un bien ?</p>
    <a href="{{ route('contact') }}" class="btn btn-primary">Contactez-nous</a>
  </div>
</section>

@endsection
