<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

    public function attachRoles() {
    }
}
