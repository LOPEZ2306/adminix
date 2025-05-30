<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::with(['user', 'saleDetails'])
            ->orderBy('sale_date', 'desc')
            ->paginate(10);

        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('quantity', '>', 0)->get();
        return view('sales.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Validar los datos del formulario
    $validated = $request->validate([
        'payment_method' => 'required|string|max:50',
        'products' => 'required|array|min:1',
        'products.*.product_id' => 'required|exists:products,id',
        'products.*.quantity' => 'required|integer|min:1',
        'products.*.price' => 'required|numeric|min:0',
        'products.*.discount' => 'nullable|numeric|min:0'
    ]);

    DB::beginTransaction();
    try {
        // Calcular el monto total
        $totalAmount = collect($validated['products'])->sum(function($item) {
            return ($item['price'] * $item['quantity']) - ($item['discount'] ?? 0);
        });

        // Crear la venta
        $sale = Sale::create([
            'sale_date' => now(),
            'payment_method' => $validated['payment_method'],
            'total_amount' => $totalAmount,
            'user_id' => auth()->id(),
        ]);

        // Procesar los detalles de la venta
        foreach ($validated['products'] as $item) {
            $product = Product::findOrFail($item['product_id']);

            if ($product->quantity < $item['quantity']) {
                throw new \Exception("Stock insuficiente para: {$product->product}");
            }

            // Crear los detalles de la venta
            $sale->saleDetails()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'discount' => $item['discount'] ?? 0,
                'subtotal' => ($item['price'] * $item['quantity']) - ($item['discount'] ?? 0),
            ]);

            // Actualizar el stock del producto
            $product->decrement('quantity', $item['quantity']);
        }

        // Confirmar la transacción
        DB::commit();

        return redirect()->route('sales.index')->with('success', 'Venta realizada correctamente.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => $e->getMessage()]);
    }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        $sale->load(['saleDetails.product', 'user']);
        return view('sales.show', compact('sale'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        try {
            DB::beginTransaction();

            // Opcionalmente, si deseas restaurar el stock al eliminar una venta:
            foreach ($sale->saleDetails as $detail) {
                $product = $detail->product;
                if ($product) {
                    $product->increment('quantity', $detail->quantity);
                }
            }

            $sale->delete();

            DB::commit();

            return redirect()->route('sales.index')
                ->with('success', 'Venta eliminada correctamente');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('sales.index')
                ->with('error', 'Error al eliminar la venta: ' . $e->getMessage());
        }
    }

    /**
     * Validar el stock disponible para un producto
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function validateStock(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::find($request->product_id);

        if ($product->quantity >= $request->quantity) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "Solo hay {$product->quantity} unidades disponibles de {$product->product}",
                'available' => $product->quantity
            ]);
        }
    }
}
