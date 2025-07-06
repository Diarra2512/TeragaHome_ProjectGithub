<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;

    /**
     * Attributs pouvant être remplis en masse
     */
    protected $fillable = [
        // relation
        'user_id',

        // informations générales
        'title',
        'type',            // villa, appartement, terrain…
        'contrat',         // vente ou location
        'city',
        'adresse',

        // caractéristiques techniques
        'surface',
        'nb_pieces',
        'nb_chambres',
        'nb_sdb',
        'etage',
        'annee_construction',

        // finances
        'price',
        'charges',
        'caution',

        // autres
        'description',
        'disponibilite',
        'equipements',     // JSON → tableau
    ];

    /**
     * Conversions automatiques de type
     */
    protected $casts = [
        'disponibilite' => 'boolean',
        'equipements'   => 'array',
    ];

    /*────────────────────
     |  Relations Eloquent
     ────────────────────*/
    // Propriétaire de l’annonce
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Galerie d’images
    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }
}
