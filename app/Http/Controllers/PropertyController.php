<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    /* ---------- PUBLIC ---------- */
    public function index(Request $request)
    {
        $query = Property::query();

        $query->when($request->city, fn($q, $v) => $q->where('city', 'like', "%$v%"))
              ->when($request->type, fn($q, $v) => $q->where('type', $v))
              ->when($request->price_max, fn($q, $v) => $q->where('price', '<=', $v));

        return view('properties.index', [
            'properties' => $query->with('images')->latest()->paginate(9),
            'filters' => $request->only(['city', 'type', 'price_max']),
        ]);
    }

    public function show(Property $property)
    {
        $property->load('images');
        return view('properties.show', compact('property'));
    }

    /* ---------- PRIVÉ ---------- */
    public function create()
    {
        return view('properties.create');
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'title'              => 'required|max:255',
            'type'               => 'required',
            'contrat'            => 'required|in:vente,location',
            'city'               => 'required',
            'adresse'            => 'nullable|string|max:255',
            'surface'            => 'nullable|numeric|min:1',
            'nb_pieces'          => 'nullable|integer|min:1',
            'nb_chambres'        => 'nullable|integer|min:0',
            'nb_sdb'             => 'nullable|integer|min:0',
            'etage'              => 'nullable|integer|min:0',
            'annee_construction' => 'nullable|integer|min:1800|max:' . date('Y'),
            'price'              => 'required|numeric|min:1000',
            'charges'            => 'nullable|numeric|min:0',
            'caution'            => 'nullable|numeric|min:0',
            'description'        => 'required|min:10',
            'disponibilite'      => 'sometimes|boolean',
            'equipements'        => 'nullable|array',
            'equipements.*'      => 'string|max:100',
            'images.*'           => 'nullable|image|max:2048',
        ]);

        // Si checkbox 'disponibilite' non cochée, forcer false
        $data['disponibilite'] = $r->boolean('disponibilite');

        // Equipements : si null, on force tableau vide
        $data['equipements'] = $r->input('equipements', []);

        $property = Auth::user()->properties()->create($data);

        if ($r->hasFile('images')) {
            foreach ($r->file('images') as $file) {
                $path = $file->store('properties', 'public');
                $property->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('dashboard')->with('success', 'Annonce publiée !');
    }

    public function edit(Property $property)
    {
        $this->authorize('update', $property);
        $property->load('images');
        return view('properties.edit', compact('property'));
    }

    public function update(Request $r, Property $property)
    {
        $this->authorize('update', $property);

        $data = $r->validate([
            'title'              => 'required|max:255',
            'type'               => 'required',
            'contrat'            => 'required|in:vente,location',
            'city'               => 'required',
            'adresse'            => 'nullable|string|max:255',
            'surface'            => 'nullable|numeric|min:1',
            'nb_pieces'          => 'nullable|integer|min:1',
            'nb_chambres'        => 'nullable|integer|min:0',
            'nb_sdb'             => 'nullable|integer|min:0',
            'etage'              => 'nullable|integer|min:0',
            'annee_construction' => 'nullable|integer|min:1800|max:' . date('Y'),
            'price'              => 'required|numeric',
            'charges'            => 'nullable|numeric|min:0',
            'caution'            => 'nullable|numeric|min:0',
            'description'        => 'required',
            'disponibilite'      => 'sometimes|boolean',
            'equipements'        => 'nullable|array',
            'equipements.*'      => 'string|max:100',
            'images.*'           => 'nullable|image|max:2048',
            'delete_images'      => 'nullable|array',
            'delete_images.*'    => 'integer|exists:property_images,id',
        ]);

        // Forcer booléen pour disponibilité
        $data['disponibilite'] = $r->boolean('disponibilite');

        // Equipements (tableau)
        $data['equipements'] = $r->input('equipements', []);

        // Supprimer les images cochées
        if ($r->has('delete_images')) {
            foreach ($r->input('delete_images') as $imageId) {
                $image = $property->images()->find($imageId);
                if ($image) {
                    \Storage::disk('public')->delete($image->image_path);
                    $image->delete();
                }
            }
        }

        $property->update($data);

        // Ajouter nouvelles images
        if ($r->hasFile('images')) {
            foreach ($r->file('images') as $file) {
                $path = $file->store('properties', 'public');
                $property->images()->create(['image_path' => $path]);
            }
        }

        return back()->with('success', 'Annonce mise à jour !');
    }

    public function destroy(Property $property)
    {
        $this->authorize('delete', $property);
        $property->delete();

        return back()->with('success', 'Annonce supprimée.');
    }

    public function home()
    {
        $latestProperties = Property::with('images')
            ->latest()
            ->take(3)
            ->get();

        return view('home', compact('latestProperties'));
    }
}
