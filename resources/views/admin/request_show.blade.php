@extends('layouts.admin')

@section('content')
<div class="container mt-5" style="background-color: #fdfaf4; padding: 30px; border-radius: 10px;">
    <h2 class="mb-4 text-center fw-bold" style="color: #51653f;">Détails de la demande</h2>

    <div class="card shadow border-0 rounded-4 mb-4">
        <div class="card-body px-4 py-3">
            <p class="mb-2"><strong class="text-muted">Nom :</strong> {{ $contactRequest->last_name }} {{ $contactRequest->first_name }}</p>
            <p class="mb-2"><strong class="text-muted">Email :</strong> {{ $contactRequest->email }}</p>
            <p class="mb-2"><strong class="text-muted">Téléphone :</strong> {{ $contactRequest->phone }}</p>
            <p class="mb-2"><strong class="text-muted">Objet :</strong> {{ $contactRequest->objet_demande }}</p>
            <p class="mb-2"><strong class="text-muted">Message :</strong><br> {{ $contactRequest->message }}</p>
            <p class="mb-0"><strong class="text-muted">Date :</strong> {{ $contactRequest->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <div class="text-end">
        <a href="{{ route('admin.requests.index') }}" class="btn btn-outline-primary">← Retour à la liste</a>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card-body p {
        font-size: 15px;
        line-height: 1.6;
    }

    .btn-outline-primary {
        color: #51653f;
        border-color: #51653f;
    }

    .btn-outline-primary:hover {
        background-color: #51653f;
        color: rgb(65, 94, 31);
        border-color: #51653f;
    }
</style>
@endpush
