<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Epreuve;

class PublicEventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('inscription', compact('events'));
    }

    public function inscription()
{
    // Logic for handling the inscription
    return view('inscription'); // Replace 'inscription' with the appropriate view
}


public function showEpreuves($eventId)
{

    // Find the event by ID


    $event = Event::findOrFail($eventId);

    // Retrieve all the related epreuves for the event if needed
    $epreuves = Epreuve::where('evenement_id', $eventId)->get(); // Example, adjust as needed

    // Return the view with the event data and related epreuves
    return view('inscriptionx', compact('event', 'epreuves'));
}





    public function showInscriptionOptions($eventId, $epreuveId)
    {
        $event = Event::findOrFail($eventId);  // Fetch the event using the event ID
        $epreuve = Epreuve::findOrFail($epreuveId);  // Fetch the epreuve using the epreuve ID

        return view('options', compact('event', 'epreuve'));  // Pass both variables to the view
    }

}
