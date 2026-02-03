@extends('layouts.app')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 20px;">
    <div style="margin-bottom: 25px;">
        <h2 style="margin: 0; color: #2c3e50;">Laporan Gudang</h2>
        <p style="color: #6c757d; margin: 5px 0 0 0;">Laporan transaksi dan inventori sparepart</p>
    </div>

    <!-- Filter Card -->
    <div style="background: white; border: 1px solid #dee2e6; border-radius: 8px; padding: 25px; margin-bottom: 25px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <h3 style="margin: 0 0 20px 0; color: #2c3e50; font-size: 18px; border-bottom: 2px solid #3498db; padding-bottom: 10px;">Filter Periode</h3>
        
        <form action="{{ route('reports.filter') }}" method="POST" style="display: flex; gap: 15px; align-items: end; flex-wrap: wrap;">
            @csrf
            <div style="flex: 1; min-width: 200px;">
                <label style="display: block; font-weight: 600; color: #495057; margin-bottom: 8px;">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}" required style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;">
            </div>
            
            <div style="flex: 1; min-width: 200px;">
                <label style="display: block; font-weight: 600; color: #495057; margin-bottom: 8px;">Tanggal Akhir</label>
                <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}" required style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;">
            </div>
            
            <button type="submit" style="background: #3498db; color: white; padding: 10px 24px; border: none; border-radius: 6px; cursor: pointer; font-weight: 500; font-size: 14px; height: 42px;">
                Filter
            </button>
            
            <a href="{{ route('reports.export-pdf', ['start_date' => $startDate->format('Y-m-d'), 'end_date' => $endDate->format('Y-m-d')]) }}" style="background: #dc3545; color: white; padding: 10px 24px; border-radius: 6px; text-decoration: none; font-weight: 500; font-size: 14px; display: inline-block; height: 22px; line-height: 22px;">
                Export PDF
            </a>
        </form>
    </div>

    <!-- Summary Stats -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 25px;">
        <div style="background: linear-gradient(135deg, #3498db 0%, #2980b9 100%); border-radius: 8px; padding: 25px; color: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <p style="margin: 0; font-size: 13px; opacity: 0.9; font-weight: 500;">Total Transaksi</p>
            <h2 style="margin: 10px 0 5px 0; font-size: 36px; font-weight: bold;">{{ $totalTransactions }}</h2>
            <p style="margin: 0; font-size: 12px; opacity: 0.8;">transaksi</p>
        </div>

        <div style="background: linear-gradient(135deg, #28a745 0%, #218838 100%); border-radius: 8px; padding: 25px; color: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <p style="margin: 0; font-size: 13px; opacity: 0.9; font-weight: 500;">Barang Masuk</p>
            <h2 style="margin: 10px 0 5px 0; font-size: 36px; font-weight: bold;">{{ $transactionsIn }}</h2>
            <p style="margin: 0; font-size: 12px; opacity: 0.8;">unit</p>
        </div>

        <div style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); border-radius: 8px; padding: 25px; color: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <p style="margin: 0; font-size: 13px; opacity: 0.9; font-weight: 500;">Barang Keluar</p>
            <h2 style="margin: 10px 0 5px 0; font-size: 36px; font-weight: bold;">{{ $transactionsOut }}</h2>
            <p style="margin: 0; font-size: 12px; opacity: 0.8;">unit</p>
        </div>

        <div style="background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%); border-radius: 8px; padding: 25px; color: #212529; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <p style="margin: 0; font-size: 13px; font-weight: 500;">Nilai Total Stok</p>
            <h2 style="margin: 10px 0 5px 0; font-size: 24px; font-weight: bold;">Rp {{ number_format($totalStockValue, 0, ',', '.') }}</h2>
            <p style="margin: 0; font-size: 12px; opacity: 0.8;">rupiah</p>
        </div>
    </div>

    <!-- Transactions Table -->
    <div style="background: white; border: 1px solid #dee2e6; border-radius: 8px; overflow: hidden; margin-bottom: 25px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <div style="padding: 20px; border-bottom: 2px solid #3498db; background: #f8f9fa;">
            <h3 style="margin: 0; color: #2c3e50; font-size: 18px;">Riwayat Transaksi</h3>
            <p style="margin: 5px 0 0 0; color: #6c757d; font-size: 14px;">Periode: {{ $startDate->format('d/m/Y') }} - {{ $endDate->format('d/m/Y') }}</p>
        </div>
        
        <table style="width: 100%; border-collapse: collapse;">
            <thead style="background: #343a40; color: white;">
                <tr>
                    <th style="padding: 15px; text-align: left; font-weight: 600;">Tanggal</th>
                    <th style="padding: 15px; text-align: left; font-weight: 600;">Sparepart</th>
                    <th style="padding: 15px; text-align: left; font-weight: 600;">Tipe</th>
                    <th style="padding: 15px; text-align: left; font-weight: 600;">Jumlah</th>
                    <th style="padding: 15px; text-align: left; font-weight: 600;">Catatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $tr)
                <tr style="border-bottom: 1px solid #dee2e6;">
                    <td style="padding: 15px; color: #212529;">
                        {{ \Carbon\Carbon::parse($tr->created_at)->locale('id')->isoFormat('DD MMMM YYYY') }}<br>
                        <small style="color: #6c757d;">{{ \Carbon\Carbon::parse($tr->created_at)->format('H:i') }} WIB</small>
                    </td>
                    <td style="padding: 15px; color: #212529;"><strong>{{ $tr->sparepart->nama_sparepart }}</strong></td>
                    <td style="padding: 15px;">
                        @if($tr->type === 'in')
                            <span style="background: #28a745; color: white; padding: 4px 12px; border-radius: 3px; font-size: 12px; font-weight: 500;">MASUK</span>
                        @else
                            <span style="background: #dc3545; color: white; padding: 4px 12px; border-radius: 3px; font-size: 12px; font-weight: 500;">KELUAR</span>
                        @endif
                    </td>
                    <td style="padding: 15px; color: #212529;"><strong>{{ $tr->quantity }} unit</strong></td>
                    <td style="padding: 15px; color: #6c757d;">{{ $tr->note ?: '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 40px; color: #6c757d;">
                        <p style="margin: 0; font-size: 16px;">Tidak ada transaksi pada periode ini</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Current Stock Table -->
    <div style="background: white; border: 1px solid #dee2e6; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <div style="padding: 20px; border-bottom: 2px solid #3498db; background: #f8f9fa;">
            <h3 style="margin: 0; color: #2c3e50; font-size: 18px;">Stok Saat Ini</h3>
        </div>
        
        <table style="width: 100%; border-collapse: collapse;">
            <thead style="background: #343a40; color: white;">
                <tr>
                    <th style="padding: 15px; text-align: left; font-weight: 600;">No</th>
                    <th style="padding: 15px; text-align: left; font-weight: 600;">Nama Sparepart</th>
                    <th style="padding: 15px; text-align: left; font-weight: 600;">Stok</th>
                    <th style="padding: 15px; text-align: left; font-weight: 600;">Harga</th>
                    <th style="padding: 15px; text-align: left; font-weight: 600;">Nilai Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($spareparts as $sp)
                <tr style="{{ $sp->stok < 10 ? 'background: #fff3cd;' : '' }} border-bottom: 1px solid #dee2e6;">
                    <td style="padding: 15px; color: #212529;">{{ $loop->iteration }}</td>
                    <td style="padding: 15px; color: #212529;"><strong>{{ $sp->nama_sparepart }}</strong></td>
                    <td style="padding: 15px;">
                        <strong style="color: #212529;">{{ $sp->stok }} unit</strong>
                        @if($sp->stok < 10)
                            <br><span style="background: #dc3545; color: white; padding: 3px 8px; border-radius: 3px; font-size: 11px;">RENDAH</span>
                        @endif
                    </td>
                    <td style="padding: 15px; color: #212529;">Rp {{ number_format($sp->harga, 0, ',', '.') }}</td>
                    <td style="padding: 15px; color: #212529;"><strong>Rp {{ number_format($sp->stok * $sp->harga, 0, ',', '.') }}</strong></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 40px; color: #6c757d;">
                        <p style="margin: 0; font-size: 16px;">Tidak ada data sparepart</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
