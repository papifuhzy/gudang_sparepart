@extends('layouts.app')

@section('content')
<h2>Edit Sparepart</h2>

<form action="{{ route('spareparts.update', $sparepart->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama Sparepart</label><br>
    <input type="text" name="nama_sparepart" value="{{ $sparepart->nama_sparepart }}"><br><br>

    <label>Stok</label><br>
    <input type="number" name="stok" value="{{ $sparepart->stok }}"><br><br>

    <label>Harga</label><br>
    <input type="number" name="harga" value="{{ $sparepart->harga }}"><br><br>

    <button type="submit">Update</button>
</form>

<a href="{{ route('spareparts.index') }}">Kembali</a>
@endsection
