<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    // plus de __construct()

   public function index()
    {
        // récupère les annonces de l’utilisateur connecté
        $properties = auth()->user()->properties()->latest()->paginate(10);

        // passe la variable à la vue
        return view('dashboard', compact('properties'));
    }
}
