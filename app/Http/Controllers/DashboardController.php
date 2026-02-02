<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSparepart = Sparepart::count();
        $totalStok = Sparepart::sum('stok');
        $criticalStock = Sparepart::where('stok', '<=', 10)->count();

        return view('dashboard.index', compact(
            'totalSparepart',
            'totalStok',
            'criticalStock'
        ));
    }
}
