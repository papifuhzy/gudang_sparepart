<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use Illuminate\Http\Request;

class SparepartController extends Controller
{
    public function index()
    {
        $spareparts = Sparepart::orderBy('id', 'desc')->get();
        return view('spareparts.index', compact('spareparts'));
    }

    public function create()
    {
        return view('spareparts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sparepart' => 'required',
            'stok' => 'required|integer',
            'harga' => 'required|integer',
        ]);

        Sparepart::create($request->all());

        return redirect()->route('spareparts.index')
            ->with('success', 'Sparepart berhasil ditambahkan');
    }

    public function edit($id)
    {
        $sparepart = Sparepart::findOrFail($id);
        return view('spareparts.edit', compact('sparepart'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_sparepart' => 'required',
            'stok' => 'required|integer',
            'harga' => 'required|integer',
        ]);

        $sparepart = Sparepart::findOrFail($id);
        $sparepart->update($request->all());

        return redirect()->route('spareparts.index')
            ->with('success', 'Sparepart berhasil diupdate');
    }

    public function destroy($id)
    {
        Sparepart::findOrFail($id)->delete();

        return redirect()->route('spareparts.index')
            ->with('success', 'Sparepart berhasil dihapus');
    }
}
