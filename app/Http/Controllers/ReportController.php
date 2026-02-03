<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Sparepart;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        // Default: tampilkan data bulan ini
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        
        $transactions = Transaction::with('sparepart')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();
        
        $spareparts = Sparepart::all();
        
        // Statistik
        $totalTransactions = $transactions->count();
        $transactionsIn = $transactions->where('type', 'in')->sum('quantity');
        $transactionsOut = $transactions->where('type', 'out')->sum('quantity');
        $totalStockValue = $spareparts->sum(fn($sp) => $sp->stok * $sp->harga);
        
        return view('reports.index', compact(
            'transactions',
            'spareparts',
            'totalTransactions',
            'transactionsIn',
            'transactionsOut',
            'totalStockValue',
            'startDate',
            'endDate'
        ));
    }
    
    public function filter(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        
        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate = Carbon::parse($request->end_date)->endOfDay();
        
        $transactions = Transaction::with('sparepart')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();
        
        $spareparts = Sparepart::all();
        
        // Statistik
        $totalTransactions = $transactions->count();
        $transactionsIn = $transactions->where('type', 'in')->sum('quantity');
        $transactionsOut = $transactions->where('type', 'out')->sum('quantity');
        $totalStockValue = $spareparts->sum(fn($sp) => $sp->stok * $sp->harga);
        
        return view('reports.index', compact(
            'transactions',
            'spareparts',
            'totalTransactions',
            'transactionsIn',
            'transactionsOut',
            'totalStockValue',
            'startDate',
            'endDate'
        ));
    }
    
    public function exportPdf(Request $request)
    {
        $startDate = $request->start_date 
            ? Carbon::parse($request->start_date)->startOfDay()
            : Carbon::now()->startOfMonth();
            
        $endDate = $request->end_date 
            ? Carbon::parse($request->end_date)->endOfDay()
            : Carbon::now()->endOfMonth();
        
        $transactions = Transaction::with('sparepart')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();
        
        $spareparts = Sparepart::all();
        
        // Statistik
        $totalTransactions = $transactions->count();
        $transactionsIn = $transactions->where('type', 'in')->sum('quantity');
        $transactionsOut = $transactions->where('type', 'out')->sum('quantity');
        $totalStockValue = $spareparts->sum(fn($sp) => $sp->stok * $sp->harga);
        
        $pdf = Pdf::loadView('reports.pdf', compact(
            'transactions',
            'spareparts',
            'totalTransactions',
            'transactionsIn',
            'transactionsOut',
            'totalStockValue',
            'startDate',
            'endDate'
        ));
        
        $filename = 'Laporan_Gudang_' . $startDate->format('d-m-Y') . '_' . $endDate->format('d-m-Y') . '.pdf';
        
        return $pdf->download($filename);
    }
}
