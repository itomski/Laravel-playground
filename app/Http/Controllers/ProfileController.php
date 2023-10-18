<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        // User muss angemeldet sein um die Methoden dieses Contrellers zu nutzen
        $this->middleware('auth');
    }

    public function display()
    {
        $profile = auth()->user()->profile();
        return view('profile.display', compact('profile'));
    }
}
