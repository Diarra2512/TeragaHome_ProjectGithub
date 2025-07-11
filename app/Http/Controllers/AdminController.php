<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Property;
use App\Models\ContactRequest;


class AdminController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Accès refusé.');
        }

        // Données de statistiques à afficher sur le dashboard
        $nbUsers = User::count();
        $nbProperties = \App\Models\Property::count();
        $nbRequests = \App\Models\ContactRequest::count();

        return view('admin.dashboard', compact('nbUsers', 'nbProperties', 'nbRequests'));
    }

    public function users()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Accès refusé.');
        }

        // Récupérer tous les utilisateurs sauf les admins
        $users = User::where('role', '!=', 'admin')->get();

        return view('admin.users', compact('users'));
    }

    public function storeUser(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Accès refusé.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur ajouté avec succès.');

    }

    public function destroyUser(User $user)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Accès refusé.');
        }

        if ($user->role === 'admin') {
            return back()->with('error', 'Impossible de supprimer un administrateur.');
        }

        $user->delete();

        return back()->with('success', 'Utilisateur supprimé.');
    }

    // Liste toutes les annonces (properties)
    public function properties()
    {
        $properties = Property::latest()->paginate(10);
        return view('admin.properties', compact('properties'));
    }

    // Supprimer une annonce
    public function destroyProperty(Property $property)
    {
        $property->delete();
        return back()->with('success', 'Annonce supprimée avec succès.');
    }
    public function showProperty(Property $property)
{
    return view('admin.property_show', compact('property'));
}
public function requests()
{
    $requests = ContactRequest::latest()->paginate(10);
    return view('admin.request', compact('requests'));
}


    public function showRequest(ContactRequest $contactRequest)
{
    return view('admin.request_show', compact('contactRequest'));
}


    // Supprime une demande
    public function destroyRequest(ContactRequest $contactRequest)
    {
        $contactRequest->delete();
        return redirect()->route('admin.requests.index')->with('success', 'Demande supprimée avec succès.');
    }
}
