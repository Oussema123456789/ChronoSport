<?php
namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Epreuve;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class EventController extends Controller
{
public function index(Request $request)
{
    $search = $request->input('search');

    // Vérifier si l'utilisateur est admin
    if (Auth::check() && Auth::user()->role === 'admin') {
        // Admin : voir tous les événements
        $evenements = Event::when($search, function ($query, $search) {
                return $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('nom', 'like', "%{$search}%")
                             ->orWhere('ville', 'like', "%{$search}%")
                             ->orWhere('type', 'like', "%{$search}%");
                });
            })
            ->orderBy('date', 'desc')
            ->paginate(10);
    } else {
        // Non-admin : voir uniquement ses propres événements
        $evenements = Event::where('user_id', Auth::id())
            ->when($search, function ($query, $search) {
                return $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('nom', 'like', "%{$search}%")
                             ->orWhere('ville', 'like', "%{$search}%")
                             ->orWhere('type', 'like', "%{$search}%");
                });
            })
            ->orderBy('date', 'desc')
            ->paginate(10);
    }

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
        try {
            // Debug: Log pour voir si la méthode est appelée
            Log::info('EventController store method called', [
                'has_epreuves' => $request->has('epreuves'),
                'epreuves_data' => $request->input('epreuves')
            ]);

            // Validation de base pour l'événement
            $eventValidated = $request->validate([
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

            // Gestion des fichiers
            if ($request->hasFile('image_couverture')) {
                $eventValidated['image_couverture'] = $request->file('image_couverture')->store('images', 'public');
            }

            if ($request->hasFile('image_profile')) {
                $eventValidated['image_profile'] = $request->file('image_profile')->store('images', 'public');
            }

            if ($request->hasFile('reglement')) {
                $eventValidated['reglement'] = $request->file('reglement')->store('reglements', 'public');
            }

            // Ajouter l'ID de l'utilisateur
            $eventValidated['user_id'] = Auth::id();

            // Créer l'événement
            $event = Event::create($eventValidated);
            Log::info('Event created successfully', ['event_id' => $event->id]);

            // Traiter les épreuves
            $epreuvesCreated = 0;
            if ($request->has('epreuves') && is_array($request->input('epreuves'))) {
                foreach ($request->input('epreuves') as $index => $epreuveData) {
                    Log::info('Processing epreuve', ['index' => $index, 'data' => $epreuveData]);

                    // Vérifier que les champs essentiels sont remplis
                    if (!empty($epreuveData['nom']) &&
                        !empty($epreuveData['tarif']) &&
                        !empty($epreuveData['genre']) &&
                        !empty($epreuveData['date_debut']) &&
                        !empty($epreuveData['date_fin']) &&
                        !empty($epreuveData['inscription_date_debut']) &&
                        !empty($epreuveData['inscription_date_fin'])) {

                        $epreuve = Epreuve::create([
                            'evenement_id' => $event->id,
                            'nom' => $epreuveData['nom'],
                            'tarif' => (float)$epreuveData['tarif'],
                            'genre' => $epreuveData['genre'],
                            'date_debut' => $epreuveData['date_debut'],
                            'date_fin' => $epreuveData['date_fin'],
                            'inscription_date_debut' => $epreuveData['inscription_date_debut'],
                            'inscription_date_fin' => $epreuveData['inscription_date_fin'],
                            'publier_resultat' => isset($epreuveData['publier_resultat']) && $epreuveData['publier_resultat'] == '1',
                        ]);

                        $epreuvesCreated++;
                        Log::info('Epreuve created successfully', ['epreuve_id' => $epreuve->id]);
                    } else {
                        Log::warning('Epreuve skipped due to missing data', ['index' => $index, 'data' => $epreuveData]);
                    }
                }
            }

            $message = "Événement créé avec succès";
            if ($epreuvesCreated > 0) {
                $message .= " avec {$epreuvesCreated} épreuve(s)";
            }

          // ✅ Redirection corrigée ici :
            return redirect()->route('admin.event.index')->with('success', $message);

        } catch (\Exception $e) {
            Log::error('Error in EventController store', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->withErrors(['error' => 'Une erreur est survenue: ' . $e->getMessage()])->withInput();
        }
    }
public function show(Event $event)
{
    // Eager load all necessary relationships
    $event->load([
        'sponsors',
        'epreuves.inscriptions',
        'arbitres'
    ]);

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
