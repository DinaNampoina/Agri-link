<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount('annonces')->where('role', 'vendeur')->latest()->get();

        return view('admin.users.index', compact('users'));
    }
}
