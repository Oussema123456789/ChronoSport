<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resultat extends Model
{
    use HasFactory;

    protected $fillable = [
        'inscription_id', // ajoute ce champ dans la migration
        'rang',
        'dossard',
        'nom',
        'prenom',
        'genre',
        'categorie',
        'temps',
        'club',
        'epreuve_id'
    ];

    public function epreuve()
    {
        return $this->belongsTo(Epreuve::class);
    }

    public function inscription()
    {
        return $this->belongsTo(Inscription::class);
    }
}



