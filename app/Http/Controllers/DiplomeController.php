<?php

namespace App\Http\Controllers;

use App\Models\Concurrent;
use App\Models\Event;
use App\Models\Resultat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DiplomeController extends Controller
{
    public function diplome($id)
    {
        $concurrent = Concurrent::findOrFail($id);

        // Trouver l'événement correspondant à l'épreuve (le nom de l'épreuve est stocké dans la colonne `epreuve`)
        $event = Event::where('Nom', $concurrent->epreuve)->first();

        if (!$event) {
            return redirect()->back()->withErrors('Événement non trouvé pour cette épreuve.');
        }

        // Trouver l'image associée à l'édition et à l'événement
        $image = DB::table('table_edition')
            ->where('Edition', date('Y', strtotime($concurrent->date_de_naissance))) // À adapter selon ta logique
            ->where('idevent', $event->id)
            ->value('code'); // Récupère directement la valeur du champ `code`

        return view('diplome', [
            'Runner' => $concurrent, // tu peux renommer la variable si tu veux plus de clarté
            'image' => $image
        ]);
    }
    public function show($id)
{
    $resultat = Resultat::with('epreuve')->findOrFail($id);
    return view('diplome', compact('resultat'));
}

}
