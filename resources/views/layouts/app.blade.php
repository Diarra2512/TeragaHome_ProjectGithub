<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>TerrangaHome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- CSS Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<body>
 

  <nav class="navbar navbar-expand-lg bg-white h-45 fixed-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold tex-primary" href="{{ route('home') }}">TerrangaHome</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="mainNav" class="collapse navbar-collapse">
            <ul class="navbar-nav mx-lg-auto gap-lg-4 align-items-lg-center">
                <li class="nav-item"><a class="nav-link  nav-custom" href="/">Accueil</a></li>
                <li class="nav-item"><a class="nav-link nav-custom" href="/properties">Biens</a></li>
                <li class="nav-item"><a class="nav-link nav-custom" href="/about">À propos</a></li>
                <li class="nav-item"><a class="nav-link nav-custom" href="/contact">Contact</a></li>
                <li class="nav-item"><a class="nav-link nav-custom" href="{{ route('favoris') }}">Favoris</a></li>

            </ul>

            <div class="d-flex gap-2 mt-3 mt-lg-0">
                <a href="{{ route('properties.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-search me-1"></i> Explorer
                </a>
                @auth
                    <a href="{{ route('properties.create') }}" class="btn btn-outline-primary">
                        <i class="bi bi-upload me-1"></i> + Annonce
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-outline-primary">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">Connexion</a>
                @endauth
            </div>
        </div>
    </div>
  </nav>

  <main class="w-100 p-0 m-0">
      @yield('content')
  </main>

  <footer class="bg-dark text-white pt-5 pb-4 mt-5">
    <div class="container text-md-left">
        <div class="row">
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mb-4">
                <h6 class="text-uppercase fw-bold tex-primary">TerrangaHome</h6>
                <hr class="mb-2 mt-0 d-inline-block mx-auto" >
                <p>
                    Votre portail immobilier au Sénégal : trouvez ou publiez facilement un bien à louer ou à vendre.
                </p>
            </div>

            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                <h6 class="text-uppercase fw-bold tex-primary">Navigation</h6>
                <ul class="list-unstyled">
                    <li><a href="/" class="text-white text-decoration-none">Accueil</a></li>
                    <li><a href="/properties" class="text-white text-decoration-none">Biens</a></li>
                    <li><a href="/about" class="text-white text-decoration-none">À propos</a></li>
                    <li><a href="/contact" class="text-white text-decoration-none">Contact</a></li>
                </ul>
            </div>

            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                <h6 class="text-uppercase fw-bold tex-primary">Contact</h6>
                <ul class="list-unstyled">
                    <li><i class="bi bi-geo-alt-fill me-2"></i>Dakar, Sénégal</li>
                    <li><i class="bi bi-envelope-fill me-2"></i>contact@terrangahome.sn</li>
                    <li><i class="bi bi-phone-fill me-2"></i>+221 77 123 45 67</li>
                </ul>
            </div>

            <div class="col-md-3 col-lg-4 col-xl-2 mx-auto mb-4">
                <h6 class="text-uppercase fw-bold tex-primary">Suivez-nous</h6>
                <a href="#" class="text-white me-3 fs-4"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-white me-3 fs-4"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-white me-3 fs-4"><i class="bi bi-whatsapp"></i></a>
                <a href="#" class="text-white me-3 fs-4"><i class="bi bi-youtube"></i></a>
            </div>
        </div>
    </div>
    <div class="text-center mt-4">
        © {{ date('Y') }} TerrangaHome. Tous droits réservés.
    </div>
  </footer>

  @stack('styles')
  @stack('scripts')
  
  
</body>
</html>

