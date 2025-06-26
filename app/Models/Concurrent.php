<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concurrent extends Model
{
    use HasFactory;

    protected $fillable = [
        'dossard', 'nom', 'prenom', 'genre', 'date_de_naissance',
        'nationalite', 'pays', 'epreuve', 'club', 'email',
        'tshirt', 'telephone', 'commentaire', 'cin',
    ];
    public function epreuve()
    {
        return $this->belongsTo(Epreuve::class);
    }

    public function resultat()
    {
        return $this->hasOne(Resultat::class, 'dossard', 'dossard');
    }

    public function inscription()
    {
        return $this->hasOne(Inscription::class);
    }
}
