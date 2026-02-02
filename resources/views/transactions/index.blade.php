@extends('layouts.app')

@section('content')

<h2>Transaksi Barang Masuk & Keluar</h2>

{{-- pesan error --}}
@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

{{-- pesan sukses --}}
@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

{{-- FORM TRANSAKSI --}}
<form action="{{ route('transactions.store') }}" method="POST" style="margin-bottom:20px;">
    @csrf

    <label>Sparepart</label><br>
    <select name="sparepart_id" required>
        <option value="">-- Pilih Sparepart --</option>
        @foreach($spareparts as $sp)
            <option value="{{ $sp->id }}">
                {{ $sp->nama_sparepart }} (Stok: {{ $sp->stok }})
            </option>
        @endforeach
    </select>
    <br><br>

    <label>Jenis Transaksi</label><br>
    <select name="type" required>
        <option value="in">Barang Masuk</option>
        <option value="out">Barang Keluar</option>
    </select>
    <br><br>

    <label>Jumlah</label><br>
    <input type="number" name="quantity" min="1" required>
    <br><br>

    <label>Catatan</label><br>
    <input type="text" name="note" placeholder="Opsional">
    <br><br>

    <button type="submit">Simpan Transaksi</button>
</form>

<hr>

{{-- TABEL RIWAYAT TRANSAKSI --}}
<table border="1" cellpadding="10">
    <tr>
        <th>Tanggal</th>
        <th>Nama Sparepart</th>
        <th>Tipe</th>
        <th>Jumlah</th>
        <th>Catatan</th>
    </tr>

    @forelse($transactions as $tr)
        <tr>
            <td>{{ $tr->created_at }}</td>
            <td>{{ $tr->sparepart->nama_sparepart }}</td>
            <td>
                @if($tr->type === 'in')
                    <span style="color:green;">MASUK</span>
                @else
                    <span style="color:red;">KELUAR</span>
                @endif
            </td>
            <td>{{ $tr->quantity }}</td>
            <td>{{ $tr->note }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="5">Belum ada transaksi</td>
        </tr>
    @endforelse
</table>

@endsection
