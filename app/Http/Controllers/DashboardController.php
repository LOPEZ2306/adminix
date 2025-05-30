<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Debtor;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsuarios = User::count();

        $lowStockProducts = Product::where('quantity', '<', 3)
                                  ->orderBy('quantity', 'asc')
                                  ->get();

        $latestUsers = User::latest()->take(4)->get();

        $totalDebtors = Debtor::count();

        return view('dashboard', compact('totalUsuarios', 'lowStockProducts', 'totalDebtors'));
    }
}
