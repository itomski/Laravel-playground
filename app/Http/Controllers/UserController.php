<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        // TODO: Der Angemeldete User muss ein Admin sein
        $this->middleware('auth');
    }


    public function display() {
        $users = User::all();
        return view('user.display', compact('users'));
    }

    public function createRoles() {
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'SuperAdmin']);
        Role::create(['name' => 'Sales']);
        Role::create(['name' => 'Service']);
        Role::create(['name' => 'User']);
        return redirect()->route('user.display')->with('msg', 'Die Rolen wurden erzeugt');
    }


    public function attachRoles() {

        //$user = auth()->user();
        $user = Auth::user();
        $roles = [1, 2];
        //$user->roles()->attach($roles); // Fügt etwas hinzu, ohne zu beachten ob es bereit dirn ist
        $user->roles()->syncWithoutDetaching($roles); // Fügt etwas hinzu, wenn es noch nicht drin ist


        //dd($user->roles); // Collection: ManyToMany
        //dd($user->profile); // Profile: OneToOne 
        //dd($user->profile()->first()); // Profile
        //dd($user->profile()->get()); // Collection von Profiles
        //dd($user->roles());
        return redirect()->route('user.display')->with('msg', 'Die Rolen wurde zugewiesen');
    }
}
