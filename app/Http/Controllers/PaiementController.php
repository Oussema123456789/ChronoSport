<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PaiementController extends Controller
{
    public function index()
    {
        $paiements = Paiement::with('user')->latest()->paginate(10);
        return view('organisateur.paiement.index', compact('paiements'));
    }

    public function create()
    {
        // Fetch only users with the 'admin' role (using Spatie or custom role logic)
        $users = User::all(); // Adjust if you're using a different role system

        return view('organisateur.paiement.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'user_id' => 'required|exists:users,id',
            'montant' => 'required|numeric',
            'date' => 'required|date',
        ]);

        // Create a new paiement
        Paiement::create([
            'user_id' => $request->user_id,
            'montant' => $request->montant,
            'date' => $request->date,
    ]);


        return redirect()->route('paiements.index')->with('success', 'Paiement ajouté avec succès.');
    }

    public function show(Paiement $paiement)
    {
        return view('organisateur.paiement.show', compact('paiement'));
    }

    public function edit(Paiement $paiement)
    {
        // Fetch only users with the 'admin' role for the edit page
        $users = User::where('role', 'admin')->get();  // Adjust if needed

        return view('organisateur.paiement.edit', compact('paiement', 'users'));
    }

    public function update(Request $request, Paiement $paiement)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'montant' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $paiement->update($request->all());

        return redirect()->route('paiements.index')->with('success', 'Paiement modifié avec succès.');
    }

    public function destroy(Paiement $paiement)
    {
        $paiement->delete();
        return redirect()->route('paiements.index')->with('success', 'Paiement supprimé.');
    }



}


