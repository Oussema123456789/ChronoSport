<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OrganisateurAdminController extends Controller
{
    
    // Show all organisateurs
    public function index()
    {
        $users = User::where('role', 'organisateur')->get();
        return view('organisateur.org.index', compact('users'));
    }

    // Show the form to create a new organisateur
    public function create()
    {
        return view('organisateur.org.create');
    }

    // Store a new organisateur
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telephone' => 'required|string|max:20',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'role' => 'organisateur',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('organisateur.org.index')->with('success', 'Organisateur ajouté avec succès.');
    }

    // Show a specific organisateur
    public function show($id)
    {
        $organisateur = User::findOrFail($id);
        return view('organisateur.org.show', compact('organisateur'));
    }

    // Show the form to edit an existing organisateur
    public function edit($id)
    {
        $organisateur = User::findOrFail($id);
        return view('organisateur.org.edit', compact('organisateur'));
    }

    // Update an existing organisateur
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'telephone' => 'required|string|max:20',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $organisateur = User::findOrFail($id);

        $organisateur->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'password' => $request->password ? Hash::make($request->password) : $organisateur->password,
        ]);

        return redirect()->route('organisateur.org.index')->with('success', 'Organisateur mis à jour avec succès.');
    }

    // Delete an organisateur
    public function destroy($id)
    {
        $organisateur = User::findOrFail($id);
        $organisateur->delete();

        return redirect()->route('organisateur.org.index')->with('success', 'Organisateur supprimé avec succès.');
    }
}
