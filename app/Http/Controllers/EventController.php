<?php
namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Epreuve;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class EventController extends Controller
{
public function index(Request $request)
{
    $search = $request->input('search'); // Get the search input

    $evenements = Event::where('user_id', auth()->id()) // Filter only user's events
        ->when($search, function ($query, $search) {
            return $query->where(function ($subQuery) use ($search) {
                $subQuery->where('nom', 'like', "%{$search}%")
                         ->orWhere('ville', 'like', "%{$search}%")
                         ->orWhere('type', 'like', "%{$search}%");
            });
        })
        ->orderBy('date', 'desc')
        ->paginate(10);

    return view('admin.event.index', compact('evenements'));
}



      // Show events on the client side
      public function showClientEvents()
      {
          // Get all events for client display (public side)
          $evenements = Event::all(); // You can also add filters or sorting here if needed
          return view('inscription', compact('evenements')); // Client-side view for events

      }
      public function showClientEvents1()
      {
          // Get all events for client display (public side)
          $evenements = Event::all(); // You can also add filters or sorting here if needed
          return view('calender', compact('evenements')); // Client-side view for events

      }

    public function create()
    {
        return view('admin.event.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'pays' => 'required|string|max:255',
        'ville' => 'nullable|string|max:255',
        'adresse' => 'nullable|string',
        'date' => 'required|date',
        'image_couverture' => 'required|nullable|image|mimes:jpg,jpeg,png',
        'image_profile' => 'required|nullable|image|mimes:jpg,jpeg,png',
        'type' => 'required|nullable|string',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
        'email' => 'required|nullable|email',
        'site_web' => 'nullable|string',
        'tel' => 'required|nullable|string',
        'facebook' => 'nullable|string',
        'instagram' => 'nullable|string',
        'youtube' => 'nullable|string',
        'description' => 'required|nullable|string',
        'reglement' => 'nullable|file',
    ]);

    if ($request->hasFile('image_couverture')) {
        $validated['image_couverture'] = $request->file('image_couverture')->store('images', 'public');
    }

    if ($request->hasFile('image_profile')) {
        $validated['image_profile'] = $request->file('image_profile')->store('images', 'public');
    }

    // Add user_id to associate the event with the authenticated user
    $validated['user_id'] = Auth::id();

    Event::create($validated);

    return redirect()->back()->with('success', 'Événement ajouté avec succès.');
}
public function show(Event $event)
{
    $event->load('sponsors'); // Eager load sponsors
    return view('admin.event.show', compact('event'));
}


public function edit(Event $event)
{
    $epreuves = Epreuve::where('evenement_id', $event->id)->get();

    return view('admin.event.edit', compact('event', 'epreuves'));
}



public function update(Request $request, Event $event)
{
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'pays' => 'required|string|max:255',
        'ville' => 'nullable|string|max:255',
        'adresse' => 'nullable|string',
        'date' => 'required|date',
        'image_couverture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'image_profile' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'type' => 'required|string',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
        'email' => 'required|email',
        'site_web' => 'nullable|string',
        'tel' => 'required|string',
        'facebook' => 'nullable|string',
        'instagram' => 'nullable|string',
        'youtube' => 'nullable|string',
        'description' => 'required|string',
        'reglement' => 'nullable|file',
    ]);

    // Handle file uploads if new files are provided
    if ($request->hasFile('image_couverture')) {
        $validated['image_couverture'] = $request->file('image_couverture')->store('images', 'public');
    }

    if ($request->hasFile('image_profile')) {
        $validated['image_profile'] = $request->file('image_profile')->store('images', 'public');
    }

if ($request->hasFile('reglement')) {
    // Delete the old file if exists
    if ($event->reglement && Storage::exists($event->reglement)) {
        Storage::delete($event->reglement);
    }

    // Store the new file
    $path = $request->file('reglement')->store('reglements', 'public');
    $event->reglement = $path;
}


    // Update the event
    $event->update($validated);

    return redirect()->route('admin.event.index')->with('success', 'Événement mis à jour avec succès');
}

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.event.index')->with('success', 'Événement supprimé');
    }
    public function showAssignedArbitres($eventId)
    {
        $event = Event::with('arbitres')->findOrFail($eventId);
        return view('admin.arbitre.arbitres', compact('event'));
    }
}
