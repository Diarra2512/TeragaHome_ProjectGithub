@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- ENTÊTE --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary">Demandes reçues</h2>
            <p class="text-muted mb-0">Voici les demandes que vos visiteurs ont envoyées</p>
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

    @if($requests->isEmpty())
        <div class="alert alert-info text-center p-5 rounded">
            Aucune demande pour l’instant.
        </div>
    @else
        <div class="table-responsive">
            <table class="table align-middle table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th>Annonce</th>
                        <th>Visiteur</th>
                        <th>Objet demande</th> {{-- modifié ici --}}
                        <th>Message</th>
                        <th>Statut</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $req)
                        <tr>
                            <td>
                                <a href="{{ route('properties.show', $req->property_id) }}" target="_blank">
                                    {{ $req->property->title }}
                                </a>
                            </td>
                            <td>
                                <strong>{{ $req->first_name }} {{ $req->last_name }}</strong><br>
                                <small class="text-muted">{{ $req->email }}<br>{{ $req->phone }}</small>
                            </td>
                            <td>{{ $req->objet_demande }}</td> {{-- modifié ici --}}
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
                                                <p><strong>Objet demande:</strong> {{ $req->objet_demande }}</p> {{-- modifié ici --}}
                                                <p><strong>Email:</strong> {{ $req->email }}</p>
                                                <p><strong>Téléphone:</strong> {{ $req->phone }}</p>
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
                                <form method="POST" action="{{ route('requests.update',$req) }}">
                                    @csrf @method('PATCH')
                                    <select name="status" class="form-select form-select-sm d-inline-block w-auto me-2">
                                        <option value="en_attente" @selected($req->status=='en_attente')>En attente</option>
                                        <option value="en_cours"   @selected($req->status=='en_cours')>En cours</option>
                                        <option value="traite"     @selected($req->status=='traite')>Traité</option>
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
