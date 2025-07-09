<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Epreuve;
use App\Models\Inscription;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Paiement;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

// In your controller
public function index()
{
$user = Auth::user();

// 1. Get event counts per month
$events = Event::where('user_id', $user->id)
    ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
    ->groupBy('month')
    ->pluck('count', 'month')
    ->toArray();

// Ensure all months are covered
$eventCountsByMonth = array_fill(1, 12, 0);
foreach ($events as $month => $count) {
    $eventCountsByMonth[$month] = $count;
}

// 2. Get inscription counts per month
$eventIds = Event::where('user_id', $user->id)->pluck('id');
$epreuveIds = Epreuve::whereIn('evenement_id', $eventIds)->pluck('id');

$inscriptions = Inscription::whereIn('epreuve_id', $epreuveIds)
    ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
    ->groupBy('month')
    ->pluck('count', 'month')
    ->toArray();

$inscriptionCountsByMonth = array_fill(1, 12, 0);
foreach ($inscriptions as $month => $count) {
    $inscriptionCountsByMonth[$month] = $count;
}

return view('admin.home', [
    'eventCountsByMonth' => json_encode(array_values($eventCountsByMonth)),
    'inscriptionCountsByMonth' => json_encode(array_values($inscriptionCountsByMonth)),
]);
}






    public function template($event)
    {
        // Retrieve the event by its ID
        $evenements = Event::findOrFail($event);

        // Get all epreuves related to this event with inscription count
        $epreuves = Epreuve::where('evenement_id', $event)
            ->withCount('inscriptions')
            ->get();

        // Get total inscriptions for this event
        $totalInscriptions = \App\Models\Inscription::whereIn('epreuve_id', $epreuves->pluck('id'))->count();

        // Get sponsors for this event
        $sponsors = \App\Models\Sponsor::where('evenement_id', $event)->get();

        // Get arbitres for this event (users with role 'arbitre' assigned to this event)
        $arbitres = $evenements->arbitres;

        // You can now pass this event to the view
        return view('admin.event-dashboard', [
            'event' => $evenements,
            'epreuves' => $epreuves,
            'totalInscriptions' => $totalInscriptions,
            'sponsors' => $sponsors,
            'arbitres' => $arbitres
        ]);
    }

public function template1()
{
    $year = now()->year;

    // Get monthly payment stats
    $monthlyStats = Paiement::selectRaw('MONTH(date) as month, COUNT(*) as count, SUM(montant) as total')
        ->whereYear('date', $year)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    $counts = array_fill(0, 12, 0);
    $totals = array_fill(0, 12, 0);

    foreach ($monthlyStats as $stat) {
        $index = $stat->month - 1;
        $counts[$index] = $stat->count;
        $totals[$index] = round($stat->total, 2);
    }

    // Count organisateurs
    $organisateurCount = \App\Models\User::where('role', 'organisateur')->count();

    return view('organisateur.home', compact('counts', 'totals', 'year', 'organisateurCount'));
}

    public function template2()
    {
        return view('organisateur.template');
    }

    public function userProfile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }


    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nom' => 'sometimes|string|max:255',
            'prenom' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255|unique:users,email,' . $user->id,
            'telephone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo if it exists
            if ($user->photo && Storage::exists('public/' . $user->photo)) {
                Storage::delete('public/' . $user->photo);
            }

            // Store new photo and save path
            $path = $request->file('photo')->store('profile-photos', 'public');
           $user->photo = $path;

        }

        // Update other fields
        $user->nom = $request->input('nom', $user->nom);
        $user->prenom = $request->input('prenom', $user->prenom);
        $user->email = $request->input('email', $user->email);
        $user->telephone = $request->input('telephone', $user->telephone);

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }



            public function userProfile1()
    {
        $user = Auth::user();
        return view('organisateur.profile', compact('user'));
    }


        public function updateProfile1(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nom' => 'sometimes|string|max:255',
            'prenom' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255|unique:users,email,' . $user->id,
            'telephone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo if it exists
            if ($user->photo && Storage::exists('public/' . $user->photo)) {
                Storage::delete('public/' . $user->photo);
            }

            // Store new photo and save path
            $path = $request->file('photo')->store('profile-photos', 'public');
           $user->photo = $path;

        }

        // Update other fields
        $user->nom = $request->input('nom', $user->nom);
        $user->prenom = $request->input('prenom', $user->prenom);
        $user->email = $request->input('email', $user->email);
        $user->telephone = $request->input('telephone', $user->telephone);

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
