@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f8f5f0;
    }

    h2 {
        color: #51653f;
    }

    .btn-primary {
        background-color: #51653f;
        border-color: #51653f;
    }

    .btn-primary:hover {
        background-color: #3d4f2e;
        border-color: #3d4f2e;
    }

    .btn-outline-primary {
        color: #51653f;
        border-color: #51653f;
    }

    .btn-outline-primary:hover {
        background-color: #51653f;
        color: #fff;
    }

    .alert-info {
        background-color: #e8f0e6;
        border-left: 5px solid #51653f;
        color: #2f4e2f;
    }

    .table thead {
        background-color: #51653f;
        color: white;
    }

    .table td,
    .table th {
        vertical-align: middle;
    }

    .badge.bg-success {
        background-color: #4caf50;
    }

    .badge.bg-warning {
        background-color: #ffc107;
        color: #333;
    }

    .badge.bg-secondary {
        background-color: #adb5bd;
    }

    .form-select {
        border-color: #ced4da;
    }

    .modal-content {
        border-radius: 10px;
    }

    .modal-header {
        background-color: #f1f5f1;
        border-bottom: 1px solid #dee2e6;
    }

    .modal-body {
        background-color: #fff;
    }

    .modal-footer {
        background-color: #f9faf9;
    }

</style>

<div class="container py-5">

    {{-- ENTÊTE --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>

            <h2 class="fw-bold">📨 Demandes reçues</h2>
            <p class="text-muted mb-0">Voici les demandes envoyées par vos visiteurs</p>


        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-primary rounded-pill shadow-sm">
                Retour au dashboard
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-outline-primary rounded-pill shadow-sm">
                    <i class="bi bi-box-arrow-right"></i> Déconnexion
                </button>
            </form>
        </div>
    </div>

    {{-- Aucune demande --}}
    @if($requests->isEmpty())
        <div class="alert alert-info text-center p-5 rounded">
            Aucune demande pour l’instant.
        </div>
    @else
        {{-- Liste des demandes --}}
        <div class="table-responsive">
            <table class="table align-middle table-bordered shadow-sm">
                <thead>
                    <tr>
                        <th>Annonce</th>
                        <th>Visiteur</th>
                        <th>Objet</th>
                        <th>Message</th>
                        <th>Statut</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $req)
                        <tr>
                            <td>
                                <a href="{{ route('properties.show', $req->property_id) }}" target="_blank" class="text-decoration-underline">
                                    {{ $req->property->title }}
                                </a>
                            </td>
                            <td>
                                <strong>{{ $req->first_name }} {{ $req->last_name }}</strong><br>
                                <small class="text-muted">{{ $req->email }}<br>{{ $req->phone }}</small>
                            </td>
                            <td>{{ $req->objet_demande }}</td>
                            <td>
                                {{ Str::limit($req->message, 50) }}
                                <button class="btn btn-link p-0 ms-1" data-bs-toggle="modal" data-bs-target="#msg-{{ $req->id }}">
                                    <i class="bi bi-chat-text-fill"></i>
                                </button>

                                {{-- MODAL MESSAGE --}}
                                <div class="modal fade" id="msg-{{ $req->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    Message de {{ $req->first_name }} {{ $req->last_name }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Objet :</strong> {{ $req->objet_demande }}</p>
                                                <p><strong>Email :</strong> {{ $req->email }}</p>
                                                <p><strong>Téléphone :</strong> {{ $req->phone }}</p>
                                                <hr>
                                                <p style="white-space: pre-line">{{ $req->message }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge
                                    @if($req->status=='en_attente') bg-secondary
                                    @elseif($req->status=='en_cours')  bg-warning
                                    @else                                  bg-success @endif">
                                    {{ ucfirst(str_replace('_',' ',$req->status)) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <form method="POST" action="{{ route('requests.update', $req) }}" class="d-flex align-items-center justify-content-center">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-select form-select-sm w-auto me-2">
                                        <option value="en_attente" @selected($req->status=='en_attente')>En attente</option>
                                        <option value="en_cours"   @selected($req->status=='en_cours')>En cours</option>
                                        <option value="traitée"    @selected($req->status=='traitée')>Traité</option>
                                    </select>
                                    <button class="btn btn-primary btn-sm">OK</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
