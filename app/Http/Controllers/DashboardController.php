<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Debtor;
use App\MOdels\Sale;

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

         $latestSales = Sale::with('user') // Carga el vendedor (relación user)
                        ->orderBy('sale_date', 'desc')
                        ->take(4)
                        ->get();

    return view('dashboard', compact('totalUsuarios', 'lowStockProducts', 'totalDebtors', 'latestSales'));
    }
}
