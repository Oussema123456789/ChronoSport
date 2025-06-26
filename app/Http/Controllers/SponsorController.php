<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Epreuve;
class SponsorController extends Controller
{
    // List sponsors for a specific event
    public function index($event)
    {
            $epreuves = Epreuve::where('evenement_id', $event)->get(); // Example, adjust as needed
        $event= Event::findOrFail($event); // use the same variable name
        $sponsors = $event->sponsors;

        return view('admin.sponsor.index', compact('sponsors','event','epreuves'));

    }


    // Show form to create sponsor for a specific event
public function create($event)
{
    $event = Event::findOrFail($event); // Find the event first
    $epreuves = Epreuve::where('evenement_id', $event->id)->get(); // Get epreuves for that event

    return view('admin.sponsor.create', [
        'selectedEventId' => $event->id,
        'event' => $event,
        'epreuves' => $epreuves
    ]);
}


    // Store sponsor for a specific event
    public function store(Request $request, $event)
    {
        $request->validate([
            'nom' => 'required|string',
            'image' => 'required|image',
        ]);

        $imagePath = $request->file('image')->store('sponsors', 'public');

        Sponsor::create([
            'nom' => $request->nom,
            'image' => $imagePath,
            'evenement_id' => $event,
        ]);

        return redirect()->route('events.sponsors.index', ['event' => $event])
                 ->with('success', 'Sponsor ajouté avec succès à l\'événement.');

    }

    // Unused global sponsor features (optional)
    public function show($event, $sponsor)
    {
        $epreuves = Epreuve::where('evenement_id', $event)->get();
        $event = Event::findOrFail($event);
        $sponsor = Sponsor::findOrFail($sponsor);
        return view('admin.sponsor.show', compact('sponsor','event','epreuves'));
    }

public function edit($eventId, $sponsorId)
{
    $sponsor = Sponsor::where('id', $sponsorId)
                      ->where('evenement_id', $eventId)
                      ->firstOrFail();

    $evenements = Event::all(); // optional now
    $epreuves = Epreuve::where('evenement_id', $eventId)->get();
    $event = Event::findOrFail($eventId); // ✅ Add this line

    return view('admin.sponsor.edit', compact('sponsor', 'evenements', 'epreuves', 'event')); // ✅ Add 'event'
}




   public function update(Request $request, $eventId, $sponsorId)
{

    // Find the sponsor by event ID and sponsor ID
    $sponsor = Sponsor::where('id', $sponsorId)
                      ->where('evenement_id', $eventId)
                      ->firstOrFail();

    // Validate the form data
    $request->validate([
        'nom' => 'required|string',
        'image' => 'nullable|image',
    ]);

    // Handle the image upload if a new image is provided
    if ($request->hasFile('image')) {
        // Delete the old image from the storage
        Storage::disk('public')->delete($sponsor->image);

        // Store the new image
        $imagePath = $request->file('image')->store('sponsors', 'public');
    } else {
        // If no new image, keep the old image path
        $imagePath = $sponsor->image;
    }

    // Update the sponsor with the new details, including the event ID
    $sponsor->update([
        'nom' => $request->nom,
        'image' => $imagePath,
        'evenement_id' => $eventId, // Use the eventId from the URL
    ]);

    // Redirect back with a success message
    return redirect()->route('events.sponsors.index', ['event' => $eventId])
                     ->with('success', 'Sponsor mis à jour avec succès.');
}

    public function destroy($eventId,$sponsorId)
    {
        $sponsor = Sponsor::where('id',$sponsorId)->where('evenement_id',$eventId)->firstOrFail();
        Storage::disk('public')->delete($sponsor->image);
        $sponsor->delete();

        return redirect()->route('events.sponsors.index', ['event' => $eventId])
                         ->with('success', 'Sponsor supprimé.');
    }
}

