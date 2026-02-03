@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="margin-bottom: 25px;">
        <h2 style="margin: 0; color: #2c3e50;">Tambah Sparepart</h2>
        <p style="color: #6c757d; margin: 5px 0 0 0;">Tambahkan sparepart baru ke inventori</p>
    </div>

    <div style="background: white; border: 1px solid #dee2e6; border-radius: 8px; padding: 30px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <form action="{{ route('spareparts.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; color: #495057; margin-bottom: 8px;">Nama Sparepart</label>
                <input type="text" name="nama_sparepart" required style="width: 100%; padding: 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;" placeholder="Masukkan nama sparepart">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; color: #495057; margin-bottom: 8px;">Stok Awal</label>
                <input type="number" name="stok" required style="width: 100%; padding: 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;" placeholder="0" min="0">
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; font-weight: 600; color: #495057; margin-bottom: 8px;">Harga (Rp)</label>
                <input type="number" name="harga" required style="width: 100%; padding: 12px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;" placeholder="0" min="0">
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" style="background: #28a745; color: white; padding: 12px 30px; border: none; border-radius: 6px; cursor: pointer; font-weight: 500; font-size: 15px; flex: 1;">
                    Simpan
                </button>
                <a href="{{ route('spareparts.index') }}" style="background: #6c757d; color: white; padding: 12px 30px; border-radius: 6px; text-decoration: none; display: inline-block; text-align: center; font-weight: 500; font-size: 15px;">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <div style="margin-top: 20px; text-align: center;">
        <a href="{{ route('spareparts.index') }}" style="color: #3498db; text-decoration: none; font-weight: 500;">
            ← Kembali ke Daftar Sparepart
        </a>
    </div>
</div>
@endsection
