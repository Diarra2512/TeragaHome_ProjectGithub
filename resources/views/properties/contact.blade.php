@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 650px;">

    {{-- Titre + retour --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary m-0">✉️ Nous contacter</h2>
        <a href="{{ url()->previous() }}" class="btn btn-outline-primary rounded-pill">
            <i class="bi bi-arrow-left me-1"></i> Retour
        </a>
    </div>

    {{-- Flash --}}
    @if(session('success'))
        <div class="alert alert-primary">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
            </ul>
        </div>
    @endif

    {{-- FORMULAIRE --}}
    <div class="card shadow-sm border border-primary rounded-4">
        <div class="card-body p-4">
            <form method="POST" action="{{ route('properties.contact', $property) }}">
                @csrf

                {{-- 1. Infos visiteur --}}
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-primary fw-semibold">Nom *</label>
                        <input type="text" name="last_name" class="form-control border-primary" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-primary fw-semibold">Prénom *</label>
                        <input type="text" name="first_name" class="form-control border-primary" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-primary fw-semibold">E‑mail *</label>
                        <input type="email" name="email" class="form-control border-primary" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-primary fw-semibold">Téléphone *</label>
                        <input type="text" name="phone" class="form-control border-primary" required>
                    </div>

                    {{-- 2. Objet de la demande --}}
                    <div class="col-12">
                        <label class="form-label text-primary fw-semibold">Objet de la demande *</label>
                        <select name="objet_demande" class="form-select border-primary" required>
                            <option value="">-- Choisissez une option --</option>
                            <option value="infos">Recevoir plus d'infos / photos</option>
                            <option value="dossier">Recevoir le dossier complet</option>
                            <option value="rdv">Obtenir un rendez‑vous</option>
                            <option value="appel">Être appelé au plus vite</option>
                        </select>
                    </div>

                    {{-- 3. Message --}}
                    <div class="col-12">
                        <label class="form-label text-primary fw-semibold">Votre message *</label>
                        <textarea name="message" rows="5" class="form-control border-primary" required>Je suis intéressé par votre annonce et souhaiterais obtenir davantage d’informations. Merci de bien vouloir me recontacter.</textarea>
                    </div>
                </div>

                {{-- 4. Bouton d’envoi --}}
                <div class="text-end mt-4">
                    <button class="btn btn-primary px-5 rounded-pill">
                        Envoyer la demande
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
.btn-primary{background:#0d6efd!important;border-color:#0d6efd!important;color:#fff!important}
.btn-primary:hover{background:#0843c9!important;border-color:#0843c9!important}
.btn-outline-primary{color:#0d6efd!important;border-color:#0d6efd!important}
.btn-outline-primary:hover{background:#0d6efd!important;color:#fff!important}
.form-control:focus,.form-select:focus{border-color:#0d6efd!important;box-shadow:0 0 0 .25rem rgba(13,110,253,.25)!important}
.alert-primary{background:#cfe2ff;border-color:#b6d4fe;color:#0d6efd}
</style>
@endpush
