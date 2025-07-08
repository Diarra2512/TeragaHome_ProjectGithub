<?php

namespace App\Http\Controllers;

use App\Models\ContactRequest;

class DashboardController extends Controller
{
    // Page principale du dashboard : affichage des annonces de l'utilisateur
    public function index()
    {
        $properties = auth()->user()
                            ->properties()
                            ->latest()
                            ->paginate(10);

        // Comptage rapide des demandes en attente (pour afficher badge sur bouton)
        $requestsCount = ContactRequest::whereHas('property', function($q) {
            $q->where('user_id', auth()->id());
        })
        ->where('status', 'en_attente')
        ->count();

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
}
