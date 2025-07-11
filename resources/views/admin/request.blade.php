@extends('layouts.admin')

@section('content')
<style>
    body {
        background-color: #f5f5dc;
    }

    .admin-requests-container {
        background-color: #fff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #51653f;
        font-weight: bold;
    }

    .btn-primary {
        background-color: #51653f !important;
        border-color: #51653f !important;
        color: white !important;
    }

    .btn-primary:hover {
        background-color: #3e4e31 !important;
        border-color: #3e4e31 !important;
    }

    .btn-danger {
        background-color: #b43e3e !important;
        border-color: #b43e3e !important;
        color: white !important;
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

    .btn-sm {
        font-size: 0.8rem;
        padding: 0.4rem 0.6rem;
        border-radius: 8px;
    }
</style>

<div class="container admin-requests-container">
    <h2 class="mb-4">Liste des demandes</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Objet</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $request)
                    <tr>
                        <td>{{ $request->last_name }} {{ $request->first_name }}</td>
                        <td>{{ $request->email }}</td>
                        <td>{{ $request->phone }}</td>
                        <td>{{ $request->objet_demande }}</td>
                        <td>{{ $request->created_at->format('d/m/Y') }}</td>
                        <td class="d-flex gap-2">
                            <!-- Voir plus -->
                            <a href="{{ route('admin.requests.show', $request->id) }}" class="btn btn-primary btn-sm">
                                Voir plus
                            </a>

                            <!-- Supprimer -->
                            <form action="{{ route('admin.requests.destroy', $request->id) }}" method="POST" onsubmit="return confirm('Supprimer cette demande ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Aucune demande trouvée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $requests->links() }}
    </div>
</div>
@endsection
