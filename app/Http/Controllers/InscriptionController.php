<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Inscription;
use App\Models\Epreuve;
use App\Models\Event;

class InscriptionController extends Controller
{

public function index($event, $epreuve)
{


    $inscriptions = Inscription::where('epreuve_id', $epreuve)->with('epreuve')->get();
    $epreuves = Epreuve::where('evenement_id', $event)->get();
    $event = Event::findOrFail($event);


    return view('admin.inscription.index', compact('inscriptions', 'event', 'epreuves'));

}
public function index1($event, $epreuve)
{
    $user = auth()->user();

    // Vérifier si l'utilisateur est arbitre et assigné à cet événement
    if ($user->role === 'arbitre' && !$user->events->contains($event)) {
        abort(403);
    }

    $inscriptions = Inscription::where('epreuve_id', $epreuve)->with('epreuve')->get();
    $epreuves = Epreuve::where('evenement_id', $event)->get();
    $event = Event::findOrFail($event);

    return view('arbitre.inscription.index', compact('inscriptions', 'event', 'epreuves'));
}



    public function create($eventId, $epreuveId)
    {


        $event = Event::findOrFail($eventId);
        $epreuve = Epreuve::findOrFail($epreuveId);

        return view('inscriptionevent', compact('event', 'epreuve'));
    }

    // In your InscriptionController

public function store(Request $request)
{
    $request->validate([
        'epreuve_id'     => 'required|exists:epreuves,id',
        'nom'            => 'required|string|max:255',
        'prenom'         => 'required|string|max:255',
        'email'          => 'required|email|max:255',
        'telephone'      => 'required|digits:8',
        'date_naissance' => 'required|date',
        'cin'            => 'required|digits:8',
        'genre'          => 'required|string|in:Homme,Femme',
        'nationalite'    => 'required|string|max:255',
        'club'           => 'nullable|string|max:255',
    ]);

    // Generate a random unique dossard (e.g. 10000–99999)
    do {
        $randomDossard = random_int(10000, 99999);
    } while (Inscription::where('dossard', $randomDossard)->exists());

    Inscription::create([
        'epreuve_id'     => $request->epreuve_id,
        'nom'            => $request->nom,
        'prenom'         => $request->prenom,
        'email'          => $request->email,
        'telephone'      => $request->telephone,
        'date_naissance' => $request->date_naissance,
        'cin'            => $request->cin,
        'genre'          => $request->genre,
        'nationalite'    => $request->nationalite,
        'club'           => $request->club,
        'dossard'        => $randomDossard,
    ]);

    // Find the event id from the epreuve
    $epreuve = Epreuve::findOrFail($request->epreuve_id);
    $eventId = $epreuve->evenement_id;  // your foreign key in epreuves table pointing to event

return redirect()->back()->with('success', 'Inscription soumise avec succès');

}


    public function listInscriptions()
    {
        $inscriptions = Inscription::with('epreuve')->get(); // Retrieve all inscriptions with their related epreuve data
        return view('inscriptionx', compact('inscriptions')); // Return the 'inscriptions' view with the data
    }

public function getInscription($dossard)
{
    $inscription = Inscription::where('dossard', $dossard)->with('epreuve')->first();

    if (!$inscription) {
        return response()->json(['error' => 'Aucun participant trouvé avec ce dossard.'], 404);
    }

    return response()->json([
        'nom' => $inscription->nom,
        'prenom' => $inscription->prenom,
        'genre' => $inscription->genre,
        'categorie' => $inscription->categorie,
        'club' => $inscription->club,
        'epreuve_id' => $inscription->epreuve_id,
        'epreuve' => $inscription->epreuve,  // Ajout pour renvoyer les détails de l'épreuve
    ]);
}

}


