<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\Resultat;
use App\Models\Inscription;
use App\Models\Epreuve;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ResultatController extends Controller

{
    public function show1(Event $event, Epreuve $epreuve)
    {
        $resultats = Resultat::where('epreuve_id', $epreuve->id)->get();
        return view('Resultatview', compact('event', 'epreuve', 'resultats'));
    }







    public function showclient()
    {
        $events = Event::all();
        $resultats = Resultat::all(); // Fetch all results
        return view('resultat', compact('events')); // Pass the results to the view
    }
    public function index()
    {
        $resultats = Resultat::with('epreuve')->get();
        return view('admin.resultat.index', compact('resultats'));
    }
public function create($epreuveId)
{
    $inscriptions = Inscription::where('epreuve_id', $epreuveId)->get();

    $epreuve = Epreuve::findOrFail($epreuveId);
    $event = $epreuve->evenement;  // assuming relation `evenement` exists in Epreuve model

    $epreuves = Epreuve::where('evenement_id', $event->id)->get();

    return view('admin.resultat.create', compact('epreuves', 'inscriptions', 'event'));
}



public function store(Request $request, $epreuveId)
{
    foreach ($request->results as $result) {
        Resultat::create([
            'inscription_id' => $result['inscription_id'],
            'epreuve_id'     => $epreuveId,
            'rang'           => $result['rang'],
            'dossard'        => $result['dossard'],
            'nom'            => $result['nom'],
            'prenom'         => $result['prenom'],
            'genre'          => $result['genre'],
            'categorie'      => $result['categorie'],
            'temps'          => $result['temps'],
            'club'           => $result['club'],
        ]);
    }

    return redirect()->route('resultats.index', $epreuveId)
        ->with('success', 'Résultats enregistrés avec succès.');
}



    public function show(Resultat $resultat)
    {

        return view('admin.resultat.show', compact('resultat'));
    }

    public function edit(Resultat $resultat)
    {
        $epreuves = Epreuve::all();
        return view('admin.resultat.edit', compact('resultat', 'epreuves'));
    }

    public function update(Request $request, Resultat $resultat)
    {
        $validated = $request->validate([
            'rang' => 'required|integer',
            'dossard' => 'required|string',
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'genre' => 'required|in:male,female',
            'categorie' => 'required|string',
            'temps' => 'required|numeric',
            'club' => 'required|string',
            'epreuve_id' => 'required|exists:epreuves,id',
        ]);

        $resultat->update($validated);
        return redirect()->route('resultats.index')->with('success', 'Resultat updated successfully.');
    }

    public function destroy(Resultat $resultat)
    {
        $resultat->delete();
        return redirect()->route('resultats.index')->with('success', 'Resultat deleted successfully.');
    }

    public function downloadDiplome($id)
    {
        $resultat = Resultat::with('epreuve.evenement')->findOrFail($id);
        $epreuve = $resultat->epreuve;
        $event = $epreuve->evenement;

        if (!$event) {
            abort(404, 'Événement non trouvé pour cette épreuve.');
        }

        $pdf = Pdf::loadView('diplome', compact('resultat', 'epreuve', 'event'));
        return $pdf->setPaper('a4', 'landscape')->stream('diplome_'.$resultat->dossard.'.pdf');
    }

    public function arbitreIndex(Event $event)
{
    // Get results for the assigned event for arbitre
    $resultats = Resultat::whereHas('epreuve', function($query) use ($event) {
        $query->where('evenement_id', $event->id);
    })->get();

    return view('arbitre.resultat.index', compact('resultats', 'event'));
}

public function arbitreCreate(Event $event)
{
    // Get epreuves for the event the arbitre is assigned to
    $epreuves = Epreuve::where('evenement_id', $event->id)->get();
    return view('arbitre.resultat.create', compact('epreuves', 'event'));
}

public function arbitreStore(Request $request)
{
    $validated = $request->validate([
        'rang.*' => 'required|integer',
        'dossard.*' => 'required|string',
        'nom.*' => 'required|string',
        'prenom.*' => 'required|string',
        'genre.*' => 'required|in:male,female',
        'categorie.*' => 'required|string',
        'temps.*' => 'required|string',
        'club.*' => 'nullable|string',
        'epreuve_id.*' => 'required|exists:epreuves,id',
    ]);

    $count = count($request->rang);

    $results = [];

    for ($i = 0; $i < $count; $i++) {
        $results[] = [
            'rang' => $request->rang[$i],
            'dossard' => $request->dossard[$i],
            'nom' => $request->nom[$i],
            'prenom' => $request->prenom[$i],
            'genre' => $request->genre[$i],
            'categorie' => $request->categorie[$i],
            'temps' => $request->temps[$i],
            'club' => $request->club[$i],
            'epreuve_id' => $request->epreuve_id[$i],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    // Use batch insert for better performance
    Resultat::insert($results);

    return redirect()->back()->with('success', 'Résultats enregistrés avec succès.');
}





}
