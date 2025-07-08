<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\Mail;          // ← décommente si tu ajoutes l’envoi d’e‑mail
// use App\Mail\ContactPropertyMail;             // ← idem

class PropertyController extends Controller
{
    /* -----------------------------------------------------------------
     |  PARTIE PUBLIQUE
     |-----------------------------------------------------------------*/
    public function index(Request $request)
    {
        $query = Property::query();

        $query->when($request->city,  fn ($q, $v) => $q->where('city', 'like', "%$v%"))
              ->when($request->type,  fn ($q, $v) => $q->where('type', $v))
              ->when($request->price_max, fn ($q, $v) => $q->where('price', '<=', $v));

        return view('properties.index', [
            'properties' => $query->with('images')->latest()->paginate(9),
            'filters'    => $request->only(['city', 'type', 'price_max']),
        ]);
    }

    public function show(Property $property)
    {
        $property->load('images');
        return view('properties.show', compact('property'));
    }

    /* -----------------------------------------------------------------
     |  PARTIE PRIVÉE (auth)
     |-----------------------------------------------------------------*/
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

        $data['disponibilite'] = $r->boolean('disponibilite');
        $data['equipements']   = $r->input('equipements', []);

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

        $data['disponibilite'] = $r->boolean('disponibilite');
        $data['equipements']   = $r->input('equipements', []);

        // suppression des images cochées
        if ($r->filled('delete_images')) {
            foreach ($r->input('delete_images') as $imgId) {
                $img = $property->images()->find($imgId);
                if ($img) {
                    Storage::disk('public')->delete($img->image_path);
                    $img->delete();
                }
            }
        }

        $property->update($data);

        // ajout des nouvelles images
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

    /* -----------------------------------------------------------------
     |  PAGE D’ACCUEIL
     |-----------------------------------------------------------------*/
    public function home()
    {
        $latestProperties = Property::with('images')
                                    ->latest()
                                    ->take(3)
                                    ->get();

        return view('home', compact('latestProperties'));
    }

    /* -----------------------------------------------------------------
     |  CONTACT
     |-----------------------------------------------------------------*/

    /** Affiche le formulaire de contact pour un bien */
    public function contact(Property $property)
    {
        return view('properties.contact', compact('property'));
    }

 /** Traite le formulaire « Nous contacter » d’une annonce. */
public function contactSend(Request $request, Property $property)
{
    $data = $request->validate([
        'last_name'      => 'required|string|max:100',
        'first_name'     => 'required|string|max:100',
        'email'          => 'required|email',
        'phone'          => 'required|string|max:30',
        'objet_demande'  => 'required|in:infos,dossier,rdv,appel',   // ✅ nouveau nom
        'message'        => 'required|string|max:2000',
    ]);

    /* Enregistrement en BD */
    $property->contactRequests()->create($data);

    /* (Optionnel) Envoi d’e‑mail au propriétaire
    Mail::to($property->user->email)
        ->send(new ContactPropertyMail($property, $data));
    */

    return back()->with(
        'success',
        'Votre demande a bien été envoyée. Nous vous répondrons rapidement !'
    );
}

}
