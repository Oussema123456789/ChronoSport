<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ArbitreAdminController extends Controller
{
    // Show all arbitres
    public function index()
    {
        // Get users with 'arbitre' role
        $users = User::where('role', 'arbitre')->get();

        // Get all events (or any specific events you need)
        $evenements = Event::all();

        // Pass both variables to the view
        return view('admin.arbitre.index', compact('users', 'evenements'));
    }


    // Show the form to create a new arbitre
    public function create()
    {
        return view('admin.arbitre.create');
    }

    // Store a new arbitre
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'arbitre',
        ]);

        return redirect()->route('admin.arbitre.index')->with('success', 'Arbitre ajouté avec succès.');
    }
    public function show($id)
    {
        // Find the arbitre by their ID
        $arbitre = User::findOrFail($id);

        // Return the view to show the arbitre's details
        return view('admin.arbitre.show', compact('arbitre'));
    }
    // Show the form to edit an existing arbitre
    public function edit($id)
    {
        $arbitre = User::findOrFail($id);
        return view('admin.arbitre.edit', compact('arbitre'));
    }

    // Update an existing arbitre
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        $arbitre = User::findOrFail($id);

        $arbitre->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $arbitre->password,
        ]);

        return redirect()->route('admin.arbitre.index')->with('success', 'Arbitre mis à jour avec succès.');
    }

    // Delete an arbitre
    public function destroy($id)
    {
        $arbitre = User::findOrFail($id);
        $arbitre->delete();

        return redirect()->route('admin.arbitre.index')->with('success', 'Arbitre supprimé avec succès.');
    }
 // Show form to assign arbitres to events
// Show form to assign arbitres to events
public function showAssignForm()
{
    // Get all arbitres with 'arbitre' role
    $arbitres = User::where('role', 'arbitre')->get();

    // Get all events (plural)
    $evenements = Event::all();

    // Pass both variables to the view
    return view('admin.arbitre.assign', compact('arbitres', 'evenements'));
}


// Handle assignation
// Handle assignation
public function assignArbitres(Request $request)
{
    $request->validate([
        'event_id' => 'required|exists:evenements,id', // Check for valid event ID
        'arbitres' => 'required|array', // Ensure arbitres is an array
        'arbitres.*' => 'exists:users,id', // Ensure each arbitre exists in users table
    ]);

    $event = Event::findOrFail($request->event_id); // Get the event by ID

    // Sync arbitres to the event (many-to-many relation)
    $event->arbitres()->syncWithoutDetaching($request->arbitres);

    return redirect()->route('admin.arbitre.assign')->with('success', 'Arbitres assignés avec succès.');
}

}
