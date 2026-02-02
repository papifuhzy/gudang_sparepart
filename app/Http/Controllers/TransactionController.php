<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Sparepart;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('sparepart')
            ->orderBy('created_at', 'desc')
            ->get();

        $spareparts = Sparepart::orderBy('nama_sparepart')->get();

        return view('transactions.index', compact('transactions', 'spareparts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sparepart_id' => 'required|exists:spareparts,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);

        $sparepart = Sparepart::findOrFail($request->sparepart_id);

        if ($request->type === 'out' && $sparepart->stok < $request->quantity) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi');
        }

        Transaction::create([
            'sparepart_id' => $request->sparepart_id,
            'type' => $request->type,
            'quantity' => $request->quantity,
            'note' => $request->note,
        ]);

        if ($request->type === 'in') {
            $sparepart->stok += $request->quantity;
        } else {
            $sparepart->stok -= $request->quantity;
        }

        $sparepart->save();

        return redirect()->back()->with('success', 'Transaksi berhasil disimpan');
    }
}
