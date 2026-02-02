@extends('layouts.app')

@section('content')
<h2>Data Sparepart</h2>

<a href="{{ route('spareparts.create') }}">Tambah Sparepart</a>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Stok</th>
        <th>Harga</th>
        <th>Aksi</th>
    </tr>

    @forelse($spareparts as $sp)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $sp->nama_sparepart }}</td>
        <td>
            @if($sp->stok == 0)
                <span style="color:white; background:red; padding:4px 8px;">Out of Stock</span>
            @elseif($sp->stok <= 10)
                <span style="background:yellow; padding:4px 8px;">Low</span>
            @else
                <span style="color:white; background:green; padding:4px 8px;">Safe</span>
            @endif
        </td>
        <td>{{ $sp->harga }}</td>
        <td>
            <a href="{{ route('spareparts.edit', $sp->id) }}">Edit</a>
            <form action="{{ route('spareparts.destroy', $sp->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5">Data kosong</td>
    </tr>
    @endforelse
</table>
@endsection
