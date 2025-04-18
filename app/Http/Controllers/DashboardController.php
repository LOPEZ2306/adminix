<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsuarios = User::count();

        return view('dashboard', compact('totalUsuarios'));
    }
}
