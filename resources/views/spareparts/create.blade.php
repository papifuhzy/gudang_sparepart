@extends('layouts.app')

@section('content')

<h2>Tambah Sparepart</h2>

<form action="{{ route('spareparts.store') }}" method="POST">
    @csrf

    <div style="margin-bottom: 10px;">
        <label>Nama Sparepart</label><br>
        <input type="text" name="nama_sparepart" required>
    </div>

    <div style="margin-bottom: 10px;">
        <label>Stok</label><br>
        <input type="number" name="stok" required>
    </div>

    <div style="margin-bottom: 10px;">
        <label>Harga</label><br>
        <input type="number" name="harga" required>
    </div>

    <button type="submit">Simpan</button>
</form>

<br>
<a href="{{ route('spareparts.index') }}">← Kembali</a>

@endsection
