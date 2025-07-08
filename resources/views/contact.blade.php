@extends('layouts.app')

@section('content')
<section class="container py-5 mt-4">
    <div class="row gy-5">
        <!-- Infos de contact -->
        <div class="col-md-5">
            <div class="mb-4">
                <h2 class="fw-bold text-primary">Contactez‑nous</h2>
                <p class="text-muted">Nous sommes à votre écoute pour toute question ou demande de renseignement.</p>
            </div>

            <ul class="list-unstyled fs-6">
                <li class="mb-3 d-flex align-items-start">
                    <i class="bi bi-geo-alt-fill text-success fs-5 me-3"></i>
                    <div><strong>Adresse :</strong> Dakar, Sénégal</div>
                </li>
                <li class="mb-3 d-flex align-items-start">
                    <i class="bi bi-envelope-fill text-success fs-5 me-3"></i>
                    <div><strong>Email :</strong> contact@terrangahome.sn</div>
                </li>
                <li class="mb-3 d-flex align-items-start">
                    <i class="bi bi-phone-fill text-success fs-5 me-3"></i>
                    <div><strong>Téléphone :</strong> +221 77 000 00 00</div>
                </li>
                <li class="d-flex align-items-start">
                    <i class="bi bi-clock-fill text-success fs-5 me-3"></i>
                    <div><strong>Horaires :</strong> Lun – Ven : 9h à 18h</div>
                </li>
            </ul>

            <!-- Réseaux sociaux -->
            <div class="mt-4">
                <h6 class="text-muted">Suivez‑nous</h6>
                <a href="#" class="text-success me-3 fs-4"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-success me-3 fs-4"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-success fs-4"><i class="bi bi-twitter-x"></i></a>
            </div>
        </div>

        <!-- Formulaire -->
        <div class="col-md-7">
            <div class="bg-white border rounded-4 shadow-sm p-4">
                <h4 class="fw-bold text-primary mb-4">Envoyez-nous un message</h4>
<form method="POST" action="{{ route('properties.contact', $property) }}">
    @csrf

    <!-- … autres champs … -->

    <div class="mb-3">
        <label class="form-label">Objet de la demande</label>
        <select name="objet_demande" class="form-select" required>
            <option value="">-- Choisir --</option>
            <option value="infos">Recevoir plus d'infos / photos</option>
            <option value="dossier">Recevoir le dossier complet</option>
            <option value="rdv">Obtenir un rendez‑vous</option>
            <option value="appel">Être appelé au plus vite</option>
        </select>
    </div>

    <!-- message -->
    <textarea name="message" class="form-control" rows="4" required></textarea>

    <button class="btn btn-primary mt-3">Envoyer ma demande</button>
</form>

            </div>
        </div>
    </div>
</section>
@endsection
