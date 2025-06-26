<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Inscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'epreuve_id',
        'dossard',
        'nom',
        'prenom',
        'email',
        'telephone',
        'date_naissance',
        'cin',
        'genre',
        'nationalite',
        'club',
        'dossard'
    ];

    public function epreuve()
    {
        return $this->belongsTo(Epreuve::class);
    }

    public function resultat()
    {
        return $this->hasOne(Resultat::class); // Une inscription a un résultat
    }
}

