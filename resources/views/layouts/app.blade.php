<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>TerrangaHome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-white fixed-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">TerrangaHome</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="mainNav" class="collapse navbar-collapse">
            <ul class="navbar-nav mx-lg-auto gap-lg-4 align-items-lg-center">
                <li class="nav-item"><a class="nav-link nav-custom" href="/">Accueil</a></li>
                <li class="nav-item"><a class="nav-link nav-custom" href="/properties">Biens</a></li>
                <li class="nav-item"><a class="nav-link nav-custom" href="/about">À propos</a></li>
                <li class="nav-item"><a class="nav-link nav-custom" href="/contact">Contact</a></li>
            </ul>

            <div class="d-flex gap-2 mt-3 mt-lg-0">
                <a href="{{ route('properties.index') }}" class="btn btn-nav">
                    <i class="bi bi-search me-1"></i> Explorer
                </a>
                @auth
                    <a href="{{ route('properties.create') }}" class="btn btn-nav">
                        <i class="bi bi-upload me-1"></i> + Annonce
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-nav">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-nav">Connexion</a>
                @endauth
            </div>
        </div>
    </div>
  </nav>

  <main class="w-100 p-0 m-0">
      @yield('content')
  </main>

  <footer class="bg-primary text-white pt-5 pb-4 mt-5">
    <div class="container text-md-left">
        <div class="row">
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mb-4">
                <h6 class="text-uppercase fw-bold text-white">TerrangaHome</h6>
                <hr class="mb-2 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: white; height: 2px"/>
                <p>
                    Votre portail immobilier au Sénégal : trouvez ou publiez facilement un bien à louer ou à vendre.
                </p>
            </div>

            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                <h6 class="text-uppercase fw-bold text-white">Navigation</h6>
                <ul class="list-unstyled">
                    <li><a href="/" class="text-white text-decoration-none">Accueil</a></li>
                    <li><a href="/properties" class="text-white text-decoration-none">Biens</a></li>
                    <li><a href="/about" class="text-white text-decoration-none">À propos</a></li>
                    <li><a href="/contact" class="text-white text-decoration-none">Contact</a></li>
                </ul>
            </div>

            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                <h6 class="text-uppercase fw-bold text-white">Contact</h6>
                <ul class="list-unstyled">
                    <li><i class="bi bi-geo-alt-fill me-2"></i>Dakar, Sénégal</li>
                    <li><i class="bi bi-envelope-fill me-2"></i>contact@terrangahome.sn</li>
                    <li><i class="bi bi-phone-fill me-2"></i>+221 77 123 45 67</li>
                </ul>
            </div>

            <div class="col-md-3 col-lg-4 col-xl-2 mx-auto mb-4">
                <h6 class="text-uppercase fw-bold text-white">Suivez-nous</h6>
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
  
  <style>
  /* ========== NAVIGATION ========== */
  .btn-nav {
      color: #0d6efd;
      border: 2px solid #0d6efd;
      background-color: white;
      border-radius: 2rem;
      padding: 6px 18px;
      font-weight: 500;
      transition: all 0.3s ease;
  }
  .btn-nav:hover {
      background-color: #0d6efd;
      color: #fff;
      border-color: #0d6efd;
  }

  .nav-custom {
      font-weight: 500;
      color: #212529!important;
      position: relative;
      transition: color 0.3s ease;
  }
  .nav-custom::after {
      content: "";
      position: absolute;
      bottom: -3px;
      left: 0;
      width: 0;
      height: 2px;
      background-color: #0d6efd;
      transition: width 0.3s ease;
  }
  .nav-custom:hover {
      color: #0d6efd!important;
  }
  .nav-custom:hover::after {
      width: 100%;
  }

  /* Footer social hover */
  .footer-social a {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 42px;
      height: 42px;
      border: 1px solid #fff;
      border-radius: 50%;
      transition: all 0.3s;
  }
  .footer-social a:hover {
      background: #0d6efd;
      border-color: #0d6efd;
      color: white !important;
      transform: translateY(-3px);
  }

  /* Force blue background and white text on footer */
  footer.bg-primary {
    background-color: #0d6efd !important;
    color: white !important;
  }
  footer.bg-primary * {
    color: white !important;
  }
  footer.bg-primary a {
    color: white !important;
  }
  footer.bg-primary a:hover {
    color: #0843c9 !important;
  }
  footer.bg-primary hr {
    background-color: white !important;
    height: 2px;
    border: none;
  }
  </style>

</body>
</html>
