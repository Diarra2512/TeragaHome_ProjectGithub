@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f8f5f0;
    }

    .card {
        background-color: #ffffff;
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
    }

    h1, .form-label {
        color: #344e41;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
        border: 1px solid #ced4da;
        transition: border-color 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #607d3b;
        box-shadow: 0 0 0 0.2rem rgba(96, 125, 59, 0.25);
    }

    .btn-primary {
        background-color: #607d3b;
        border-color: #607d3b;
    }

    .btn-primary:hover {
        background-color: #4e6830;
        border-color: #4e6830;
    }

    .btn-outline-primary {
        color: #607d3b;
        border-color: #607d3b;
    }

    .btn-outline-primary:hover {
        background-color: #607d3b;
        color: white;
    }

    .form-check-label {
        color: #555;
    }

    .alert-primary {
        background-color: #eef5ea;
        border-left: 4px solid #607d3b;
        color: #344e41;
    }

    #previews img {
        border-radius: 10px;
        border: 1px solid #ccc;
    }

</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card p-4 p-md-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="fw-bold text-dark mb-0">📝 Déposer une annonce</h1>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary rounded-pill">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>

                @if (session('success'))
                    <div class="alert alert-primary">{{ session('success') }}</div>
                @endif

                <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data" class="row g-4">
                    @csrf

                    <!-- Ligne 1 -->
                    <div class="col-md-6">
                        <label class="form-label">Titre *</label>
                        <input type="text" name="title" class="form-control" placeholder="Villa contemporaine" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Type *</label>
                        <select name="type" class="form-select" required>
                            <option value="">-- Choisir --</option>
                            <option value="villa">Villa</option>
                            <option value="appartement">Appartement</option>
                            <option value="terrain">Terrain</option>
                        </select>
                    </div>

                    <!-- Ligne 2 -->
                    <div class="col-md-6">
                        <label class="form-label">Ville *</label>
                        <input type="text" name="city" class="form-control" placeholder="Dakar" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Adresse / Quartier</label>
                        <input type="text" name="adresse" class="form-control" placeholder="Ngor Almadies">
                    </div>

                    <!-- Ligne 3 -->
                    <div class="col-md-4">
                        <label class="form-label">Surface (m²)</label>
                        <input type="number" name="surface" class="form-control" min="1">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Pièces</label>
                        <input type="number" name="nb_pieces" class="form-control" min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Chambres</label>
                        <input type="number" name="nb_chambres" class="form-control" min="0">
                    </div>

                    <!-- Ligne 4 -->
                    <div class="col-md-4">
                        <label class="form-label">Salles de bain</label>
                        <input type="number" name="nb_sdb" class="form-control" min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Étage (si appart.)</label>
                        <input type="number" name="etage" class="form-control" min="0">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">État</label>
                        <select name="etat" class="form-select">
                            <option value="">-- Sélectionner --</option>
                            <option value="neuf">Neuf</option>
                            <option value="bon">Bon état</option>
                            <option value="renover">À rénover</option>
                        </select>
                    </div>

                    <!-- Ligne 5 -->
                    <div class="col-md-6">
                        <label class="form-label">Contrat *</label>
                        <select name="contrat" class="form-select" required>
                            <option value="vente">Vente</option>
                            <option value="location">Location</option>
                            <option value="colocation">Colocation</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Prix (FCFA) *</label>
                        <input type="number" name="price" class="form-control" min="0" required>
                    </div>

                    <!-- Ligne 6 -->
                    <div class="col-md-6">
                        <label class="form-label">Charges mensuelles (si loc.)</label>
                        <input type="number" name="charges" class="form-control" min="0">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Caution (si loc.)</label>
                        <input type="number" name="caution" class="form-control" min="0">
                    </div>

                    <!-- Ligne 7 -->
                    <div class="col-md-6">
                        <label class="form-label">Disponible immédiatement ?</label>
                        <select name="disponibilite" class="form-select">
                            <option value="1">Oui</option>
                            <option value="0">Non</option>
                        </select>
                    </div>

                    <!-- Commodités -->
                    <div class="col-12">
                        <label class="form-label">Commodités</label>
                        <div class="row">
                            @foreach(['climatisation','piscine','jardin','garage','balcon','ascenseur','securite','cuisine_equipee','internet'] as $equip)
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="equipements[]" value="{{ $equip }}" id="eq-{{ $equip }}">
                                        <label class="form-check-label" for="eq-{{ $equip }}">
                                            {{ ucfirst(str_replace('_',' ',$equip)) }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-12">
                        <label class="form-label">Description *</label>
                        <textarea name="description" rows="5" class="form-control" required></textarea>
                    </div>

                    <!-- Images -->
                    <div class="col-12">
                        <label class="form-label">Images (plusieurs possibles)</label>
                        <input type="file" id="images" name="images[]" class="form-control" accept="image/*" multiple>
                        <div id="previews" class="d-flex flex-wrap gap-2 mt-3"></div>
                    </div>

                    <!-- Boutons -->
                    <div class="col-12 d-flex justify-content-between">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary px-4">Annuler</a>
                        <button type="submit" class="btn btn-primary btn-lg px-5 rounded-pill shadow-sm">📤 Publier l’annonce</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('images').addEventListener('change', e => {
        const previewContainer = document.getElementById('previews');
        previewContainer.innerHTML = '';
        [...e.target.files].forEach(file => {
            const img = document.createElement('img');
            img.classList.add('img-thumbnail');
            img.style.maxHeight = '150px';
            img.style.objectFit = 'cover';
            img.src = URL.createObjectURL(file);
            previewContainer.appendChild(img);
        });
    });
</script>
@endpush

@endsection
