@extends('layouts.app')

@section('content')
<section class="py-0" style="background: linear-gradient(135deg, #e6f0ec, #f8f9fa); min-height: 100vh;">
    <div class="container-fluid">
        <div class="row g-0 min-vh-100">
            
            <!-- Image à gauche : pleine hauteur -->
            <div class="col-md-6 d-none d-md-block">
                <div class="h-100 w-100">
                    <img src="{{ asset('images/contact2.jpg') }}"
                         class="img-fluid w-100 h-100 object-fit-cover"
                         style="object-fit: cover;"
                         alt="Image de contact">
                </div>
            </div>

            <!-- Infos de contact à droite -->
            <div class="col-md-6 d-flex align-items-center justify-content-center p-5">
                <div style="max-width: 600px;">
                    <h2 class="fw-bold text-success mb-4" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                        Contactez-nous
                    </h2>
                    <p class="text-secondary fs-5 mb-5" style="line-height: 1.6;">
                        Nous sommes disponibles pour répondre à toutes vos questions. N’hésitez pas à nous contacter via les moyens ci-dessous.
                    </p>

                    <ul class="list-unstyled fs-5 mb-5">
                        <li class="mb-4 d-flex align-items-center">
                            <i class="bi bi-geo-alt-fill text-success me-3 fs-3"></i>
                            <span>Dakar, Sénégal</span>
                        </li>
                        <li class="mb-4 d-flex align-items-center">
                            <i class="bi bi-envelope-fill text-success me-3 fs-3"></i>
                            <a href="mailto:contact@terrangahome.sn" class="text-success text-decoration-none fw-semibold">contact@terrangahome.sn</a>
                        </li>
                        <li class="mb-4 d-flex align-items-center">
                            <i class="bi bi-phone-fill text-success me-3 fs-3"></i>
                            <a href="tel:+221770000000" class="text-success text-decoration-none fw-semibold">+221 77 000 00 00</a>
                        </li>
                        <li class="mb-4 d-flex align-items-center">
                            <i class="bi bi-clock-fill text-success me-3 fs-3"></i>
                            <span>Lun – Ven : 9h à 18h</span>
                        </li>
                    </ul>

                    <!-- Réseaux sociaux -->
                    <div class="d-flex align-items-center gap-4">
                        <a href="#" class="social-icon d-flex justify-content-center align-items-center rounded-circle text-white bg-success"
                           style="width: 48px; height: 48px;">
                            <i class="bi bi-facebook fs-4"></i>
                        </a>
                        <a href="#" class="social-icon d-flex justify-content-center align-items-center rounded-circle text-white bg-success"
                           style="width: 48px; height: 48px;">
                            <i class="bi bi-instagram fs-4"></i>
                        </a>
                        <a href="#" class="social-icon d-flex justify-content-center align-items-center rounded-circle text-white bg-success"
                           style="width: 48px; height: 48px;">
                            <i class="bi bi-twitter fs-4"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .social-icon:hover {
        background-color: #2f5230 !important;
        text-decoration: none;
        box-shadow: 0 4px 10px rgba(47, 82, 48, 0.5);
    }

    .object-fit-cover {
        object-fit: cover;
    }
</style>
@endpush
@endsection
