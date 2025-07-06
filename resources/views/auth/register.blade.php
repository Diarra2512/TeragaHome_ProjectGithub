@extends('layouts.app')

@section('content')
<div class="container py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg border-0 w-100" style="max-width: 500px;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 text-primary">Créer un compte</h3>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label text-primary fw-semibold">Nom complet</label>
                    <input type="text" name="name" id="name" class="form-control border-primary shadow-sm" required value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label text-primary fw-semibold">Adresse email</label>
                    <input type="email" name="email" id="email" class="form-control border-primary shadow-sm" required value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label text-primary fw-semibold">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control border-primary shadow-sm" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label text-primary fw-semibold">Confirmation du mot de passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control border-primary shadow-sm" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 fw-semibold">S'inscrire</button>
            </form>

            <div class="text-center mt-3">
                <a href="{{ route('login') }}" class="text-primary text-decoration-none">
                    Vous avez déjà un compte ? <strong>Se connecter</strong>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Forcer bleu partout où c’est vert */

    /* Titres et labels */
    h3.text-primary,
    label.text-primary,
    a.text-primary {
        color: #0d6efd !important;
    }

    /* Inputs bordure et focus */
    input.form-control {
        border-color: #0d6efd !important;
    }
    input.form-control:focus {
        border-color: #0d6efd !important;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25) !important;
    }

    /* Bouton */
    button.btn-primary {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        color: #fff !important;
    }
    button.btn-primary:hover {
        background-color: #0843c9 !important;
        border-color: #0843c9 !important;
    }

    /* Lien hover */
    a.text-primary:hover {
        color: #0843c9 !important;
        text-decoration: underline !important;
    }
</style>
@endpush
