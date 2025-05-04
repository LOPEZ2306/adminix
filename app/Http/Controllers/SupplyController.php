<?php

namespace App\Http\Controllers;

use App\Models\Supply;
use App\Models\SupplyDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplies = Supply::with(['user', 'supplyDetails'])
            ->orderBy('supply_date', 'desc')
            ->paginate(10);

        return view('supply.index', compact('supplies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::orderBy('product', 'asc')->get();
        return view('supply.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $supply = Supply::create([
            'supply_date' => now(),
            'user_id' => Auth::id(),
            'total_amount' => 0,
        ]);

        $totalAmount = 0;

        foreach ($request->products as $productData) {
            $product = Product::findOrFail($productData['product_id']);
            $quantity = $productData['quantity'];

            // Aumentar stock
            $product->incrementStock($quantity);

            SupplyDetail::create([
                'supply_id' => $supply->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);

            $totalAmount += $product->price * $quantity;
        }

        $supply->update(['total_amount' => $totalAmount]);

        return redirect()->route('supplies.index')->with('success', 'Reabastecimiento registrado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supply = Supply::with(['user', 'supplyDetails.product'])->findOrFail($id);
        return view('supply.show', compact('supply'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supply = Supply::findOrFail($id);

        // Opcionalmente: revertir los cambios de stock al eliminar
        foreach ($supply->supplyDetails as $detail) {
            $product = $detail->product;
            $product->decrementStock($detail->quantity);
        }

        // Eliminar los detalles primero
        SupplyDetail::where('supply_id', $id)->delete();

        // Eliminar el abastecimiento
        $supply->delete();

        return redirect()->route('supplies.index')
            ->with('success', 'Abastecimiento eliminado correctamente');
    }

    /**
     * Get product information by ID
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProduct($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }
}
