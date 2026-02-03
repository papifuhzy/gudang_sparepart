<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Sparepart;
use App\Services\EmailNotificationService;

class TransactionController extends Controller
{
    protected EmailNotificationService $emailService;

    public function __construct(EmailNotificationService $emailService)
    {
        $this->emailService = $emailService;
    }

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

        $transaction = Transaction::create([
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

        // Send transaction notification email
        try {
            $this->emailService->sendTransactionNotification($transaction->load('sparepart'));
        } catch (\Exception $e) {
            \Log::error('Email notification failed: ' . $e->getMessage());
        }

        // Note: Low stock alerts are now sent via bulk check, not per transaction
        // to prevent email spam. Use Check Low Stock button in Notifications settings.

        return redirect()->back()->with('success', 'Transaksi berhasil disimpan! Email notifikasi terkirim.');
    }
}

