@extends('layouts.admin')

@section('content')
<style>
    body {
        background-color: #f5f5dc;
    }

    .admin-users-container {
        background-color: #fff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #51653f;
        font-weight: bold;
    }

    .form-control:focus {
        border-color: #51653f;
        box-shadow: 0 0 0 .2rem rgba(81, 101, 63, 0.25);
    }

    .btn-success {
        background-color: #51653f !important;
        border-color: #51653f !important;
    }

    .btn-success:hover {
        background-color: #3e4e31 !important;
        border-color: #3e4e31 !important;
    }

    .btn-danger {
        background-color: #b43e3e !important;
        border-color: #b43e3e !important;
    }

    .table thead {
        background-color: #51653f;
        color: white;
    }

    .table td, .table th {
        vertical-align: middle;
    }

    .alert {
        border-radius: 8px;
    }

    .btn i {
        font-size: 1.2rem;
    }
</style>

<div class="container admin-users-container">
    <h2 class="mb-4">Gérer les utilisateurs</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Ajouter un utilisateur -->
    <form action="{{ route('admin.users.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="row g-2">
            <div class="col-md-3">
                <input type="text" name="name" placeholder="Nom" class="form-control" required>
            </div>
            <div class="col-md-3">
                <input type="email" name="email" placeholder="Email" class="form-control" required>
            </div>
            <div class="col-md-3">
                <input type="password" name="password" placeholder="Mot de passe" class="form-control" required>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-success w-100">Ajouter</button>
            </div>
        </div>
    </form>

    <!-- Liste des utilisateurs -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Date création</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        <td>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Aucun utilisateur</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
