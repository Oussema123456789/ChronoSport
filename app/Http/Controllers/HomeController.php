<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Paiement;
use App\Models\Event;
use App\Models\Inscription;
use App\Models\Epreuve;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
public function index(Request $request)
{
    $user = Auth::user();

    if ($user->role === 'organisateur') {
        // Récupérer le nombre d'événements par mois pour cet organisateur
        $events = Event::where('user_id', $user->id)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')->toArray();

        // Initialise tableau mois 1 à 12 avec 0
        $eventCountsByMonth = array_fill(1, 12, 0);
        foreach ($events as $month => $count) {
            $eventCountsByMonth[$month] = $count;
        }

        // Récupérer les IDs des événements pour récupérer les épreuves
        $eventIds = Event::where('user_id', $user->id)->pluck('id');

        // Récupérer les IDs des épreuves liées à ces événements
        $epreuveIds = Epreuve::whereIn('evenement_id', $eventIds)->pluck('id');

        // Récupérer le nombre d'inscriptions par mois liées à ces épreuves
        $inscriptions = Inscription::whereIn('epreuve_id', $epreuveIds)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')->toArray();

        // Initialise tableau mois 1 à 12 avec 0
        $inscriptionCountsByMonth = array_fill(1, 12, 0);
        foreach ($inscriptions as $month => $count) {
            $inscriptionCountsByMonth[$month] = $count;
        }

        // Add this line to fix undefined variable error:
           $organisateurCount = \App\Models\User::where('role', 'organisateur')->count();

    return view('admin.home', [
        'eventCountsByMonth' => json_encode(array_values($eventCountsByMonth)),
        'inscriptionCountsByMonth' => json_encode(array_values($inscriptionCountsByMonth)),
        'organisateurCount' => $organisateurCount,  // <<< add this
    ]);
}
    elseif ($user->role === 'arbitre') {
        return view('arbitre.home');
    }
    elseif ($user->role === 'admin') {
        $year = $request->query('year', now()->year);

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

        // 👉 Get the number of organisateurs
        $organisateurCount = \App\Models\User::where('role', 'organisateur')->count();

        return view('organisateur.home', compact('counts', 'totals', 'year', 'organisateurCount'));
    }
    else {
        abort(403, 'Unauthorized action.');
    }
}


    // In your controller

}
