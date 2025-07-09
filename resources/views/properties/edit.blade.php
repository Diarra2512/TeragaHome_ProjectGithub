@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 900px;">

    <!-- En‑tête -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary m-0">✏️ Modifier l’annonce</h2>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary rounded-pill shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Retour
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-primary">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm rounded-4 p-4 border border-primary">
        <form method="POST" action="{{ route('properties.update', $property) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- ---------- 1. Infos principales ---------- --}}
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label tex-primary fw-semibold">Titre *</label>
                    <input type="text" name="title" class="form-control border-primary"
                           value="{{ old('title',$property->title) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label tex-primary fw-semibold">Type *</label>
                    <select name="type" class="form-select border-primary" required>
                        @foreach(['villa','appartement','terrain'] as $t)
                            <option value="{{ $t }}" @selected($property->type===$t)>{{ ucfirst($t) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label tex-primary fw-semibold">Ville *</label>
                    <input type="text" name="city" class="form-control border-primary"
                           value="{{ old('city',$property->city) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label tex-primary fw-semibold">Adresse / Quartier</label>
                    <input type="text" name="adresse" class="form-control border-primary"
                           value="{{ old('adresse',$property->adresse) }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label tex-primary">Surface (m²)</label>
                    <input type="number" name="surface" class="form-control border-primary"
                           value="{{ old('surface',$property->surface) }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label tex-primary">Pièces</label>
                    <input type="number" name="nb_pieces" class="form-control border-primary"
                           value="{{ old('nb_pieces',$property->nb_pieces) }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label tex-primary">Chambres</label>
                    <input type="number" name="nb_chambres" class="form-control border-primary"
                           value="{{ old('nb_chambres',$property->nb_chambres) }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label tex-primary">Salles de bain</label>
                    <input type="number" name="nb_sdb" class="form-control border-primary"
                           value="{{ old('nb_sdb',$property->nb_sdb) }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label tex-primary">Étage</label>
                    <input type="number" name="etage" class="form-control border-primary"
                           value="{{ old('etage',$property->etage) }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label tex-primary">Année constr.</label>
                    <input type="number" name="annee_construction" class="form-control border-primary"
                           value="{{ old('annee_construction',$property->annee_construction) }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label tex-primary">État</label>
                    <select name="etat" class="form-select border-primary">
                        @foreach(['neuf','bon','renover'] as $e)
                            <option value="{{ $e }}" @selected($property->etat===$e)>{{ ucfirst($e) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label tex-primary fw-semibold">Contrat *</label>
                    <select name="contrat" class="form-select border-primary" required>
                        @foreach(['vente','location','colocation'] as $c)
                            <option value="{{ $c }}" @selected($property->contrat===$c)>{{ ucfirst($c) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label tex-primary fw-semibold">Prix (FCFA) *</label>
                    <input type="number" name="price" class="form-control border-primary"
                           value="{{ old('price',$property->price) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label tex-primary">Charges (FCFA)</label>
                    <input type="number" name="charges" class="form-control border-primary"
                           value="{{ old('charges',$property->charges) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label tex-primary">Caution (FCFA)</label>
                    <input type="number" name="caution" class="form-control border-primary"
                           value="{{ old('caution',$property->caution) }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label tex-primary">Disponible ?</label>
                    <select name="disponibilite" class="form-select border-primary">
                        <option value="1" @selected($property->disponibilite)>Oui</option>
                        <option value="0" @selected(!$property->disponibilite)>Non</option>
                    </select>
                </div>
            </div>

            {{-- ---------- 2. Commodités ---------- --}}
            @php $eq = $property->equipements ?? []; @endphp
            <div class="mt-4">
                <label class="form-label fw-semibold tex-primary">Commodités</label>
                <div class="row">
                    @foreach(['climatisation','piscine','jardin','garage','balcon','ascenseur','securite','cuisine_equipee','internet'] as $e)
                        <div class="col-md-4 col-sm-6">
                            <div class="form-check">
                                <input class="form-check-input border-primary"
                                       type="checkbox" name="equipements[]"
                                       value="{{ $e }}" id="eq-{{ $e }}"
                                       @checked(in_array($e,$eq))>
                                <label class="form-check-label text-dark" for="eq-{{ $e }}">
                                    {{ ucfirst(str_replace('_',' ',$e)) }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- ---------- 3. Description ---------- --}}
            <div class="mt-4">
                <label class="form-label fw-semibold tex-primary">Description *</label>
                <textarea name="description" rows="5" class="form-control border-primary"
                          required>{{ old('description',$property->description) }}</textarea>
            </div>

            {{-- ---------- 4. Images existantes ---------- --}}
            <div class="mt-4">
                <label class="form-label fw-semibold tex-primary">Images actuelles</label>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($property->images as $img)
                        <div class="text-center">
                            <img src="{{ asset('storage/'.$img->image_path) }}" class="img-thumbnail border-primary"
                                 style="max-height:120px">
                            <div class="form-check mt-1">
                                <input class="form-check-input border-primary"
                                       type="checkbox" name="delete_images[]"
                                       value="{{ $img->id }}" id="del-{{ $img->id }}">
                                <label class="form-check-label tex-primary small" for="del-{{ $img->id }}">
                                    Supprimer
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- ---------- 5. Ajouter nouvelles images ---------- --}}
            <div class="mt-4">
                <label class="form-label fw-semibold tex-primary">Ajouter des images</label>
                <input type="file" name="images[]" multiple accept="image/*"
                       class="form-control border-primary">
                <div id="previews" class="d-flex flex-wrap gap-2 mt-3"></div>
            </div>

            {{-- ---------- 6. Boutons ---------- --}}
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-primary rounded-pill">
                    <i class="bi bi-x-circle"></i> Annuler
                </a>
                <button class="btn btn-primary rounded-pill shadow-sm">
                    <i class="bi bi-check-circle"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

@push('styles')

@endpush

@push('scripts')
<script>
document.querySelector('input[name="images[]"]').addEventListener('change', e=>{
    const box=document.getElementById('previews'); box.innerHTML='';
    [...e.target.files].forEach(f=>{
        const img=document.createElement('img');
        img.src=URL.createObjectURL(f);
        img.className='img-thumbnail border-primary'; img.style.maxHeight='120px'; img.style.objectFit='cover';
        box.appendChild(img);
    });
});
</script>
@endpush
@endsection
