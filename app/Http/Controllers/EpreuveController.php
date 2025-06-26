<?php

namespace App\Http\Controllers;

use App\Models\Epreuve;
use App\Models\Evenement;
use App\Models\Event;
use Illuminate\Http\Request;

class EpreuveController extends Controller
{
    // List epreuves for a specific event
    public function index($event)
    {
        $event = Event::findOrFail($event);
        $epreuves = $event->epreuves;
        return view('admin.epreuve.index', compact('event', 'epreuves'));
    }



    // Show form to create epreuve for a specific event
    public function create($event)
    {
        $epreuves = Epreuve::where('evenement_id', $event)->get();
        $event = Event::findOrFail($event);
        return view('admin.epreuve.create', ['selectedEventId' => $event->id, 'event' => $event, 'epreuves' => $epreuves]);
    }


    // Store epreuve for a specific event
    public function store(Request $request, $event)
    {
        $request->validate([
            'nom' => 'required|string',
            'tarif' => 'required|numeric',
            'genre' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'inscription_date_debut' => 'required|date',
            'inscription_date_fin' => 'required|date',
        ]);


        Epreuve::create([
            'nom' => $request->nom,
            'tarif' => $request->tarif,
            'genre' => $request->genre,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'inscription_date_debut' => $request->inscription_date_debut,
            'inscription_date_fin' => $request->inscription_date_fin,
            'publier_resultat' => $request->has('publier_resultat'),
            'evenement_id' => $event,
        ]);

        return redirect()->route('events.epreuves.index', ['event' => $event])
                         ->with('success', 'Épreuve ajoutée avec succès.');
    }

    // Show details for a specific epreuve
    public function show($event, $epreuve)
    {
        $epreuve = Epreuve::where('evenement_id',operator: $event)->findOrFail($epreuve);
        $epreuves = Epreuve::where('evenement_id', $event)->get();

        $event = Event::findOrFail($event);

        return view('admin.epreuve.show', compact('epreuve', 'event','epreuves'));
    }

fffffffffffffff
    // Show form to edit epreuve
public function edit($eventId, $epreuveId)
{
    $epreuve = Epreuve::where('evenement_id', $eventId)
                      ->where('id', $epreuveId)
                      ->firstOrFail();

    $event = Event::findOrFail($eventId);
    $epreuves = Epreuve::where('evenement_id', $eventId)->get(); // Define it

    return view('admin.epreuve.edit', compact('epreuve', 'event', 'epreuves'));
}

    // Update epreuve for a specific event
    public function update(Request $request, $eventId, $epreuveId)
    {
        $epreuve = Epreuve::where('evenement_id',$eventId)->where('id',$epreuveId)->firstOrFail();

        $request->validate([
            'nom' => 'required|string',
            'tarif' => 'required|numeric',
            'genre' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'inscription_date_debut' => 'required|date',
            'inscription_date_fin' => 'required|date',
        ]);

        $epreuve->update([
            'nom' => $request->nom,
            'tarif' => $request->tarif,
            'genre' => $request->genre,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'inscription_date_debut' => $request->inscription_date_debut,
            'inscription_date_fin' => $request->inscription_date_fin,
            'publier_resultat' => $request->has('publier_resultat'),

        ]);

        return redirect()->route('events.epreuves.index', $eventId)
                         ->with('success', 'Épreuve mise à jour avec succès.');
    }

    // Delete a specific epreuve
    public function destroy($event, $epreuve)
    {
        $epreuve = Epreuve::findOrFail($epreuve);
        $epreuve->delete();

        return redirect()->route('events.epreuves.index', $event)
                         ->with('success', 'Épreuve supprimée avec succès.');
    }


}
