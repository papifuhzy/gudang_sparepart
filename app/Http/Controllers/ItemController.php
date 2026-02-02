<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    // ================================
    // TAMPILKAN SEMUA DATA
    // URL: /items
    // ================================
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    // ================================
    // FORM TAMBAH DATA
    // URL: /items/create
    // ================================
    public function create()
    {
        return view('items.create');
    }

    // ================================
    // SIMPAN DATA KE DATABASE
    // METHOD: POST
    // ================================
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required|integer',
            'harga' => 'required|numeric'
        ]);

        Item::create([
            'nama_barang' => $request->nama_barang,
            'stok' => $request->stok,
            'harga' => $request->harga
        ]);

        return redirect('/items')->with('success', 'Data berhasil ditambahkan');
    }

    // ================================
    // FORM EDIT DATA
    // URL: /items/{id}/edit
    // ================================
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('items.edit', compact('item'));
    }

    // ================================
    // UPDATE DATA
    // METHOD: PUT
    // ================================
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required|integer',
            'harga' => 'required|numeric'
        ]);

        $item = Item::findOrFail($id);
        $item->update($request->all());

        return redirect('/items')->with('success', 'Data berhasil diupdate');
    }

    // ================================
    // HAPUS DATA
    // METHOD: DELETE
    // ================================
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect('/items')->with('success', 'Data berhasil dihapus');
    }
}
