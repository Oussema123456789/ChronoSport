<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class OrganisateurController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('organisateur.org.index', compact('users'));
    }

    public function create()
    {
        return view('organisateur.org.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'telephone' => 'nullable|string',
        ]);

        User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telephone' => $request->telephone,
            'role' => 'admin',
        ]);

        return redirect()->route('organisateurs.index')->with('success', 'Organisateur ajouté avec succès.');
    }

 public function edit($id)
{
    $organisateur = User::findOrFail($id);
    return view('organisateur.org.edit', compact('organisateur'));
}

    public function show($id)
    {
        $organisateur = User::findOrFail($id); // You can modify this based on your logic, like filtering by role

        return view('organisateur.org.show', compact('organisateur')); // You can modify the view name
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'telephone' => 'nullable|string',
        ]);

        $user->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
        ]);

        return redirect()->route('organisateurs.index')->with('success', 'Organisateur mis à jour.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('organisateurs.index')->with('success', 'Organisateur supprimé.');
    }



}
