@extends('layouts.app')

@section('content')
<div class=" py-5 d-flex justify-content-center align-items-center min-vh-100"
style="background-image: url('/images/famille.jpg'); background-size: cover; background-position: center ; ">
    <div class="card shadow-lg border-0 w-100" style="max-width: 500px;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 tex-primary">Créer un compte</h3>

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
                    <label for="name" class="form-label tex-primary fw-semibold">Nom complet</label>
                    <input type="text" name="name" id="name" class="form-control border-primary shadow-sm" required value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label tex-primary fw-semibold">Adresse email</label>
                    <input type="email" name="email" id="email" class="form-control border-primary shadow-sm" required value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label tex-primary fw-semibold">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control border-primary shadow-sm" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label tex-primary fw-semibold">Confirmation du mot de passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control border-primary shadow-sm" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 fw-semibold">S'inscrire</button>
            </form>

            <div class="text-center mt-3">
                <a href="{{ route('login') }}" class="tex-primary text-decoration-none">
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
        color: #51653f !important;
    }


    

    /* Boutons */
    .btn-primary {
        background-color: #51653f !important;
        border-color: #51653f !important;
    }

    .btn-primary:hover {
        background-color: #3e4d33 !important;
        border-color: #3e4d33 !important;
    }

    /* Alertes */
    .alert-danger {
        background-color: #f8d7da !important;
        color: #721c24 !important;
    }

    
    
</style>
@endpush
