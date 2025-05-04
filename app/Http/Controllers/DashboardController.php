<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsuarios = User::count();

        $lowStockProducts = Product::where('quantity', '<', 3)
                                  ->orderBy('quantity', 'asc')
                                  ->get();

        $latestUsers = User::latest()->take(4)->get();

        return view('dashboard', compact('totalUsuarios', 'lowStockProducts', ));
    }
}
