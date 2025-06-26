<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event; // ✅ CORRECT
use App\Models\Epreuve;
class ArbitreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function home() {
        return view('arbitre.home');
    }

    public function profile() {
        return view('arbitre.profile');
    }

    public function updateProfile(Request $request) {
        // Handle update logic
    }
    public function assignedEvents()
{
    $user = Auth::user();
    $events = $user->events; // Assuming 'events' relationship is defined

    return view('arbitre.events.index', compact('events'));
}
public function showEvent($event)
{
             $evenements = Event::findOrFail($event);
// Get all epreuves related to this event
$epreuves = Epreuve::where('evenement_id', $event)->get();
    return view('arbitre.events.show', ['event' => $evenements,'epreuves'=>$epreuves]);
}




    public function myEvents() {
        $user = auth()->user();
        $events = $user->events; // assuming a many-to-many relation
        return view('arbitre.events', compact('events'));
    }

    public function resultats(Event $event) {
        return view('arbitre.resultats', compact('event'));
    }

    public function submitResultats(Request $request, Event $event) {
        // Handle submission
    }



}
