@extends('layouts.admin')

@section('content')
<style>
    body {
        background-color: #f5f5dc;
    }

    .admin-properties-container {
        background-color: #fff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #51653f;
        font-weight: bold;
    }

    .table thead {
        background-color: #51653f;
        color: white;
    }

    .table td, .table th {
        vertical-align: middle;
        font-size: 15px;
    }

    .table tbody tr:hover {
        background-color: #f2f4f3;
    }

    .btn-sm {
        font-size: 0.8rem;
        padding: 0.4rem 0.6rem;
        border-radius: 8px;
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
        background-color: #dc3545 !important;
        border-color: #dc3545 !important;
        color: white !important;
    }

    .btn-danger:hover {
        background-color: #bb2d3b !important;
        border-color: #bb2d3b !important;
    }

    .alert-success {
        background-color: #e6f4e5;
        border-left: 5px solid #51653f;
        color: #2e5c34;
        padding: 0.75rem 1rem;
        border-radius: 6px;
        margin-bottom: 1rem;
    }

    .pagination .page-link {
        color: #51653f;
        border: 1px solid #dee2e6;
    }

    .pagination .page-link:hover {
        background-color: #51653f;
        color: white;
    }

    .pagination .active .page-link {
        background-color: #51653f;
        border-color: #51653f;
        color: white;
    }
</style>

<div class="container admin-properties-container">
    <h2 class="mb-4">Gérer les annonces</h2>

    @if(session('success')) 
        <div class="alert alert-success">{{ session('success') }}</div> 
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Propriétaire</th>
                    <th>Date création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($properties as $property)
                    <tr>
                        <td>{{ $property->id }}</td>
                        <td>{{ $property->title }}</td>
                        <td>{{ $property->user->name ?? 'N/A' }}</td>
                        <td>{{ $property->created_at->format('d/m/Y') }}</td>
                        <td class="d-flex gap-2">
                            <!-- Voir plus -->
                            <a href="{{ route('admin.properties.show', $property) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-eye"></i> Voir plus
                            </a>

                            <!-- Supprimer -->
                            <form action="{{ route('admin.properties.destroy', $property) }}" method="POST" onsubmit="return confirm('Supprimer cette annonce ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted">Aucune annonce</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $properties->links() }}
    </div>
</div>
@endsection
