<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        // User muss angemeldet sein um die Methoden dieses Contrellers zu nutzen
        $this->middleware('auth');
    }

    public function display()
    {
        $profile = auth()->user()->profile;
        if(!$profile) {
            $profile = new Profile();
        }
        return view('profile.display', compact('profile'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // Validierung
        ]);

        if($request->input('id') > 0) {
            // Profil wird upgedatet
            Profile::find($request->input('id'))
                ->fill($request->all())
                ->save();
        }
        else {
            Profile::create([
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'birthdate' => $request->input('birthdate'),
                'street' => $request->input('street'),
                'street_nr' => $request->input('street_nr'),
                'city' => $request->input('city'),
                'zip' => $request->input('zip'),
                'user_id' => auth()->user()->id,
            ]);
        }

        return redirect()->route('profile.display')
            ->with('msg', 'Profil wurde gespeichert');
    }
}
