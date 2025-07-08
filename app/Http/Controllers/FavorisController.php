<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class FavorisController extends Controller
{
    public function index()
    {
        // On ne renvoie pas encore de données côté serveur
        return view('favoris');
    }
}
