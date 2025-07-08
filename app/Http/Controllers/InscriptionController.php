<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Inscription;
use App\Models\Epreuve;
use App\Models\Event;
use App\Models\FormConfiguration;

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

        // Récupérer la configuration du formulaire pour cet événement
        $formConfig = FormConfiguration::getConfigForEvent($eventId);

        return view('inscriptionevent-dynamic', compact('event', 'epreuve', 'formConfig'));
    }

    /**
     * Affiche le formulaire d'ajout d'inscription pour l'admin
     */
    public function adminCreate($eventId, $epreuveId)
    {
        $event = Event::findOrFail($eventId);
        $epreuve = Epreuve::findOrFail($epreuveId);
        $epreuves = Epreuve::where('evenement_id', $eventId)->get();

        return view('admin.inscription.create', compact('event', 'epreuve', 'epreuves'));
    }

    // In your InscriptionController

public function store(Request $request)
{
    // Récupérer l'épreuve et l'événement pour la configuration
    $epreuve = Epreuve::findOrFail($request->epreuve_id);
    $eventId = $epreuve->evenement_id;

    // Récupérer la configuration du formulaire
    $formConfig = FormConfiguration::getConfigForEvent($eventId);

    // Construire les règles de validation dynamiquement
    $validationRules = ['epreuve_id' => 'required|exists:epreuves,id'];

    foreach ($formConfig as $fieldName => $fieldSettings) {
        if ($fieldSettings['enabled']) {
            $rules = [];

            if ($fieldSettings['required']) {
                $rules[] = 'required';
            } else {
                $rules[] = 'nullable';
            }

            // Ajouter les règles spécifiques selon le champ
            switch ($fieldName) {
                case 'nom':
                case 'prenom':
                case 'nationalite':
                case 'club':
                    $rules[] = 'string|max:255';
                    break;
                case 'email':
                    $rules[] = 'email|max:255';
                    break;
                case 'telephone':
                case 'cin':
                    $rules[] = 'digits:8';
                    break;
                case 'date_naissance':
                    $rules[] = 'date';
                    break;
                case 'genre':
                    $rules[] = 'string|in:Homme,Femme';
                    break;
            }

            $validationRules[$fieldName] = implode('|', $rules);
        } else {
            // Si le champ est désactivé, on ne le valide pas du tout
            // mais on s'assure qu'il ne sera pas dans les données
        }
    }

    $request->validate($validationRules);

    // Generate a random unique dossard (e.g. 10000–99999)
    do {
        $randomDossard = random_int(10000, 99999);
    } while (Inscription::where('dossard', $randomDossard)->exists());

    // Préparer les données d'inscription en fonction de la configuration
    $inscriptionData = [
        'epreuve_id' => $request->epreuve_id,
        'dossard' => $randomDossard,
    ];

    // Ajouter seulement les champs activés et qui ont une valeur
    foreach ($formConfig as $fieldName => $fieldSettings) {
        if ($fieldSettings['enabled']) {
            $value = $request->input($fieldName);
            // Ajouter le champ seulement s'il a une valeur ou s'il est obligatoire
            if ($value !== null && $value !== '') {
                $inscriptionData[$fieldName] = $value;
            } elseif ($fieldSettings['required']) {
                // Si le champ est obligatoire mais vide, on met null (la validation aura déjà échoué)
                $inscriptionData[$fieldName] = null;
            }
            // Si le champ est optionnel et vide, on ne l'ajoute pas du tout
        }
    }

    Inscription::create($inscriptionData);

    // Find the event id from the epreuve
    $epreuve = Epreuve::findOrFail($request->epreuve_id);
    $eventId = $epreuve->evenement_id;  // your foreign key in epreuves table pointing to event

return redirect()->back()->with('success', 'Inscription soumise avec succès');

}

    /**
     * Traite la soumission du formulaire d'inscription admin
     */
    public function adminStore(Request $request)
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
        $eventId = $epreuve->evenement_id;

        return redirect()->route('inscriptions.index', ['event' => $eventId, 'epreuve' => $request->epreuve_id])
                        ->with('success', 'Inscription ajoutée avec succès');
    }

    /**
     * Affiche le formulaire de modification d'inscription pour l'admin
     */
    public function adminEdit($eventId, $epreuveId, $inscriptionId)
    {
        $event = Event::findOrFail($eventId);
        $epreuve = Epreuve::findOrFail($epreuveId);
        $inscription = Inscription::findOrFail($inscriptionId);
        $epreuves = Epreuve::where('evenement_id', $eventId)->get();

        return view('admin.inscription.edit', compact('event', 'epreuve', 'inscription', 'epreuves'));
    }

    /**
     * Met à jour une inscription
     */
    public function adminUpdate(Request $request, $eventId, $epreuveId, $inscriptionId)
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

        $inscription = Inscription::findOrFail($inscriptionId);

        $inscription->update([
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
        ]);

        // Find the event id from the epreuve
        $epreuve = Epreuve::findOrFail($request->epreuve_id);
        $eventId = $epreuve->evenement_id;

        return redirect()->route('inscriptions.index', ['event' => $eventId, 'epreuve' => $request->epreuve_id])
                        ->with('success', 'Inscription modifiée avec succès');
    }

    /**
     * Supprime une inscription
     */
    public function adminDestroy($eventId, $epreuveId, $inscriptionId)
    {
        $inscription = Inscription::findOrFail($inscriptionId);
        $inscription->delete();

        return redirect()->route('inscriptions.index', ['event' => $eventId, 'epreuve' => $epreuveId])
                        ->with('success', 'Inscription supprimée avec succès');
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


