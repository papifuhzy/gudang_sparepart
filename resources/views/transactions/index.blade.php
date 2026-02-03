@extends('layouts.app')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 20px;">
    <div style="margin-bottom: 25px;">
        <h2 style="margin: 0; color: #2c3e50;">Transaksi Barang</h2>
        <p style="color: #6c757d; margin: 5px 0 0 0;">Kelola transaksi barang masuk dan keluar</p>
    </div>

    @if(session('error'))
        <div style="background: #f8d7da; border-left: 4px solid #dc3545; color: #721c24; padding: 15px 20px; border-radius: 4px; margin-bottom: 20px;">
            <strong>Error:</strong> {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div style="background: #d4edda; border-left: 4px solid #28a745; color: #155724; padding: 15px 20px; border-radius: 4px; margin-bottom: 20px;">
            <strong>Berhasil:</strong> {{ session('success') }}
        </div>
    @endif

    <!-- Form Transaksi Card -->
    <div style="background: white; border: 1px solid #dee2e6; border-radius: 8px; padding: 30px; margin-bottom: 30px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <h3 style="margin-top: 0; color: #2c3e50; font-size: 18px; border-bottom: 2px solid #3498db; padding-bottom: 10px; margin-bottom: 20px;">Tambah Transaksi Baru</h3>
        
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; font-weight: 600; color: #495057; margin-bottom: 8px;">Sparepart</label>
                    <select name="sparepart_id" required style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;">
                        <option value="">-- Pilih Sparepart --</option>
                        @foreach($spareparts as $sp)
                            <option value="{{ $sp->id }}">{{ $sp->nama_sparepart }} (Stok: {{ $sp->stok }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label style="display: block; font-weight: 600; color: #495057; margin-bottom: 8px;">Jenis Transaksi</label>
                    <select name="type" required style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;">
                        <option value="in">Barang Masuk</option>
                        <option value="out">Barang Keluar</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-weight: 600; color: #495057; margin-bottom: 8px;">Jumlah</label>
                    <input type="number" name="quantity" min="1" required style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; color: #495057; margin-bottom: 8px;">Catatan (Opsional)</label>
                    <input type="text" name="note" placeholder="Tambahkan catatan" style="width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 4px; font-size: 14px;">
                </div>
            </div>

            <button type="submit" style="background: #28a745; color: white; padding: 12px 30px; border: none; border-radius: 6px; cursor: pointer; font-weight: 500; font-size: 15px;">
                Simpan Transaksi
            </button>
        </form>
    </div>

    <!-- Riwayat Transaksi Card -->
    <div style="background: white; border: 1px solid #dee2e6; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <div style="padding: 20px; border-bottom: 2px solid #3498db;">
            <h3 style="margin: 0; color: #2c3e50; font-size: 18px;">Riwayat Transaksi</h3>
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
                    <td style="padding: 15px; color: #212529;">{{ $tr->created_at->format('d/m/Y H:i') }}</td>
                    <td style="padding: 15px; color: #212529;"><strong>{{ $tr->sparepart->nama_sparepart }}</strong></td>
                    <td style="padding: 15px;">
                        @if($tr->type === 'IN')
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
                        <p style="margin: 0; font-size: 16px;">Belum ada transaksi</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
