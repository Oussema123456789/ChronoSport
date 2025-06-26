<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Epreuve extends Model
{
    use HasFactory;

    protected $fillable = [
        'evenement_id',
        'nom',
        'tarif',
        'genre',
        'date_debut',
        'date_fin',
        'inscription_date_debut',
        'inscription_date_fin',
        'publier_resultat',
    ];

    // 🔗 Relation: Epreuve belongs to an Evenement
    public function evenement()
    {
        return $this->belongsTo(Event::class);
    }

    // 🔗 Relation: Epreuve has many Concurrents
    public function concurrents()
    {
        return $this->hasMany(Concurrent::class);
    }

    // 🔗 Relation: Epreuve has many Resultats
    public function resultats()
    {
        return $this->hasMany(Resultat::class);
    }

    // 🔗 Relation: Epreuve has many Inscriptions
    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }
}
