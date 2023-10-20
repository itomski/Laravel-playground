<?php

namespace App\Http\Controllers;

use App\Mail\RoleAttachMail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function __construct()
    {
        // TODO: Der Angemeldete User muss ein Admin sein
        $this->middleware('auth'); // Prüft, ob User angemeldet ist
        //$this->middleware('can:isAdmin'); // Prüft, ob User Admin ist
    }


    public function display() {
        $this->authorize('isAdmin');
        $users = User::all();
        return view('user.display', compact('users'));
    }

    public function createRoles() {
        $this->authorize('isAdmin');

        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'SuperAdmin']);
        Role::create(['name' => 'Sales']);
        Role::create(['name' => 'Service']);
        Role::create(['name' => 'User']);
        return redirect()->route('user.display')->with('msg', 'Die Rolen wurden erzeugt');
    }

    public function attachRoles(Request $request) {

        $this->authorize('isAdmin');

        //dd($request);

        $user = User::find($request->input('user_id'));
        $roles = $request->input('role_id');
        $user->roles()->syncWithoutDetaching($roles);

        // Versendet die Mail sofort
        //Mail::to($user)->send(new RoleAttachMail($user));

        // Packt die Mail in eine Queue, wo sie durch ein Worker asynchron verschickt wird
        Mail::to($user)->queue(new RoleAttachMail($user));

        //$user = auth()->user();
        //$user = Auth::user();
        //$roles = [1, 2];
        //$user->roles()->attach($roles); // Fügt etwas hinzu, ohne zu beachten ob es bereit dirn ist
        //$user->roles()->syncWithoutDetaching($roles); // Fügt etwas hinzu, wenn es noch nicht drin ist


        //dd($user->roles); // Collection: ManyToMany
        //dd($user->profile); // Profile: OneToOne 
        //dd($user->profile()->first()); // Profile
        //dd($user->profile()->get()); // Collection von Profiles
        //dd($user->roles());
        return redirect()->route('user.display')->with('msg', 'Die Rolen wurde zugewiesen');
    }

    public function rolesAttachForm() {

        $this->authorize('isAdmin');

        $users = User::all();
        $roles = Role::all();
        return view('user.roles', compact('users', 'roles'));
    }
}
