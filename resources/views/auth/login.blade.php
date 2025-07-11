@extends('layouts.app')

@section('content')
<div class=" py-5 d-flex justify-content-center align-items-center min-vh-100 bg-cover" 
style="background-image: url('/images/famille.jpg'); background-size: cover; background-position: center ; ">
    <div class="card shadow-lg border-0 w-100" style="max-width: 500px;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 tex-primary">Se connecter</h3>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label tex-primary fw-semibold">Adresse email</label>
                    <input type="email" name="email" id="email" class="form-control border-primary shadow-sm" required value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label tex-primary fw-semibold">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control border-primary shadow-sm" required>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input border-prim">
                    <label class="form-check-label tex-primary fw-semibold" for="remember">Se souvenir de moi</label>
                </div>

                <button type="submit" class="btn btn-primary w-100 fw-semibold">Connexion</button>
            </form>

            <div class="text-center mt-3">
                <a href="{{ route('register') }}" class="tex-primary text-decoration-none">
                    Pas encore inscrit ? <strong>S'inscrire</strong>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')

@endpush
