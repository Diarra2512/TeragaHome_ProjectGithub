<?php

namespace App\Http\Controllers;
use App\Models\Property;
use App\Models\ContactRequest;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    // Page principale du dashboard : affichage des annonces de l'utilisateur
    public function index()
    {
        $properties = auth()->user()
                            ->properties()
                            ->latest()
                            ->paginate(10);
$requestsCount = ContactRequest::whereHas('property', function($q) {
    $q->where('user_id', auth()->id());
})->count();


     

        return view('dashboard', compact('properties', 'requestsCount'));
    }

    // Page dédiée pour lister les demandes reçues sur les annonces de l'utilisateur
    public function requests()
    {
        $requests = ContactRequest::with('property')
            ->whereHas('property', fn($q) => $q->where('user_id', auth()->id()))
            ->latest()
            ->paginate(10);

        return view('dashboard.requests', compact('requests'));
    }
// DashboardController.php
public function updateRequest(Request $request, ContactRequest $contactRequest)
{
    $validated = $request->validate([
        'status' => 'required|in:en_attente,en_cours,traitée',
    ]);

    $contactRequest->status = $validated['status'];
    $contactRequest->save();

    return redirect()->back()->with('success', 'Statut mis à jour avec succès.');
}

}
