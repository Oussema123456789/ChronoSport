<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\User;
use App\Models\counter;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AvisController extends Controller
{


    public function showAvis()
    {
        $avis = Avis::all(); // fetch all testimonial entries
        return view('/welcome', compact('avis')); // pass data to the view
    }
    public function create()
{
    return view('avis_form');
}

public function store(Request $request)
{
    $request->validate([
        'client' => 'required|string|max:255',
        'message' => 'required|string',
        'organisation' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $avis = new Avis();
    $avis->client = $request->client;
    $avis->message = $request->message;
    $avis->organisation = $request->organisation;

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);
        $avis->image = $filename;
    }

    $avis->save();

    return redirect()->route('avis.create')->with('success', 'Merci pour votre témoignage !');
}


}
