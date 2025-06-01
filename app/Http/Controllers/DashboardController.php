<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Debtor;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

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

        $latestSales = Sale::with('user')
                        ->orderBy('sale_date', 'desc')
                        ->take(4)
                        ->get();

        $topSeller = Sale::select('user_id', DB::raw('COUNT(*) as total_sales'))
                        ->groupBy('user_id')
                        ->orderByDesc('total_sales')
                        ->with('user')
                        ->first();

        $topProduct = DB::table('sale_details')
            ->select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->first();

        $topSoldProduct = null;

        if ($topProduct) {
            $product = Product::find($topProduct->product_id);
            if ($product) {
                $topSoldProduct = [
                    'name' => $product->product,
                    'total_sold' => $topProduct->total_sold
                ];
            }
        }

        return view('dashboard', compact(
            'totalUsuarios',
            'lowStockProducts',
            'latestUsers',
            'totalDebtors',
            'latestSales',
            'topSeller',
            'topSoldProduct'
        ));
    }
}
