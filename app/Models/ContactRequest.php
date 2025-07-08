<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    protected $fillable = [
        'property_id',
        'last_name',
        'first_name',
        'email',
        'phone',
        'objet_demande', // nouveau nom du champ
        'message',
        'status',
    ];

    // 1 demande → 1 bien
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    // accès direct au propriétaire de l’annonce (utile pour l’e‑mail)
    public function owner()
    {
        return $this->property->user();
    }

    // retourne le libellé lisible de l'objet
    
}
