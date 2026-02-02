@extends('layouts.app')

@section('content')

<h2>Dashboard Gudang</h2>

<div style="display:flex; gap:20px; margin-top:20px;">
    <div style="background:#e3f2fd; padding:20px; width:200px;">
        <h4>Total Sparepart</h4>
        <h2>{{ $totalSparepart }}</h2>
    </div>

    <div style="background:#e8f5e9; padding:20px; width:200px;">
        <h4>Total Stok</h4>
        <h2>{{ $totalStok }}</h2>
    </div>

    <div style="background:#ffebee; padding:20px; width:200px;">
        <h4>Critical Stock</h4>
        <h2>{{ $criticalStock }}</h2>
    </div>
</div>

@endsection
