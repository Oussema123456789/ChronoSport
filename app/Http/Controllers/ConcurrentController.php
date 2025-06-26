<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use App\Models\Concurrent;
use Illuminate\Http\Request;

class ConcurrentController extends Controller
{
    public function index()
    {
        // 1) transformer toutes les inscriptions en concurrents (1 seule fois)
        Inscription::chunk(100, function($chunk){
            foreach($chunk as $ins){
                Concurrent::firstOrCreate(
                    ['email' => $ins->email],
                    [
                      'dossard'        => rand(1000, 9999),
                      'nom'            => $ins->nom,
                      'prenom'         => $ins->prenom,
                      'genre'          => $ins->genre,
                      'date_de_naissance'=> $ins->date_naissance,
                      'nationalite'    => $ins->nationalite,
                      'club'           => $ins->club,
                      'cin'            => $ins->cin,
                      'telephone'      => $ins->telephone,
                      // si vous stockez aussi epreuve_id :
                      'epreuve_id'     => $ins->epreuve_id,
                    ]
                );
            }
        });

        // 2) afficher tous les concurrents
        $concurrents = Concurrent::with('epreuve')->get();
        return view('admin.concurrent.index', compact('concurrents'));
    }




  public function showByDossard($dossard){$concurrent = Concurrent::where('dossard', $dossard)->with('epreuve')->first();

        if (! $concurrent) {
            return response()->json(['message'=>'Non trouvé'], 404);
        }

        return response()->json($concurrent);
    }
}
