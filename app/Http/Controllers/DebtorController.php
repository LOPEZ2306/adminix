<?php

namespace App\Http\Controllers;

use App\Models\Debtor;
use Illuminate\Http\Request;

class DebtorController extends Controller
{
    public function index()
    {

    $debtors = Debtor::paginate(10);

    // Obtener el total de deudores
    $totalDebtors = Debtor::count();

    // Pasar la variable totalDebtors a la vista
    return view('debtors.index', compact('debtors', 'totalDebtors'));
    }

    public function create()
    {
        return view('debtors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'cedula' => 'required|string|max:100|unique:debtors,cedula',
            'residencia' => 'required|string|max:255',
            'deuda' => 'required|numeric|min:0',
        ]);

        Debtor::create($request->all());

        return redirect()->route('debtors.index')->with('success', 'Deudor creado correctamente.');
    }

    public function show(Debtor $debtor)
    {
        return view('debtors.show', compact('debtor'));
    }

    public function edit(Debtor $debtor)
    {
        return view('debtors.edit', compact('debtor'));
    }

    public function update(Request $request, Debtor $debtor)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'cedula' => 'required|string|max:100|unique:debtors,cedula,' . $debtor->id,
            'residencia' => 'required|string|max:255',
            'deuda' => 'required|numeric|min:0',
        ]);

        $debtor->update($request->all());

        return redirect()->route('debtors.index')->with('success', 'Deudor actualizado correctamente.');
    }

    public function destroy(Debtor $debtor)
    {
        $debtor->delete();
        return redirect()->route('debtors.index')->with('success', 'Deudor eliminado correctamente.');
    }

    public function pay(Request $request)
{
    $request->validate([
        'debtor_id' => 'required|exists:debtors,id',
        'amount' => 'required|numeric|min:0.01',
    ]);

    $debtor = Debtor::findOrFail($request->debtor_id);

    if ($request->amount > $debtor->deuda) {
        return redirect()->route('debtors.index')->with('error', 'El monto ingresado excede la deuda.');
    }

    // Restar el monto pagado
    $debtor->deuda -= $request->amount;

    if ($debtor->deuda <= 0) {
        // Si la deuda queda en 0 o menos, eliminar el deudor
        $debtor->delete();
        return redirect()->route('debtors.index')->with('success', 'Pago registrado y deudor eliminado automáticamente.');
    } else {
        // Si aún queda deuda, solo guardar el nuevo valor
        $debtor->save();
        return redirect()->route('debtors.index')->with('success', 'Pago registrado exitosamente.');
    }
}

}
