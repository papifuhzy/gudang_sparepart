@extends('layouts.app')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 20px;">
    <div style="margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h2 style="margin: 0; color: #2c3e50;">Data Sparepart</h2>
            <p style="color: #6c757d; margin: 5px 0 0 0;">Kelola inventori sparepart komputer</p>
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('notifications.settings') }}" style="background: #17a2b8; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: 500; display: inline-flex; align-items: center; gap: 8px; transition: background 0.3s;">
                Notifikasi Email
            </a>
            <a href="{{ route('spareparts.create') }}" style="background: #28a745; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: 500; display: inline-flex; align-items: center; gap: 8px; transition: background 0.3s;">
                + Tambah Sparepart
            </a>
        </div>
    </div>

    <!-- Search Bar -->
    <div style="background: white; border: 1px solid #dee2e6; border-radius: 8px; padding: 20px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <form action="{{ route('spareparts.index') }}" method="GET" style="display: flex; gap: 10px; align-items: center;">
            <div style="flex: 1;">
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari sparepart berdasarkan nama..." style="width: 100%; padding: 12px 15px; border: 1px solid #ced4da; border-radius: 6px; font-size: 14px;">
            </div>
            <button type="submit" style="background: #3498db; color: white; padding: 12px 30px; border: none; border-radius: 6px; cursor: pointer; font-weight: 500; font-size: 14px;">
                Cari
            </button>
            @if($search)
                <a href="{{ route('spareparts.index') }}" style="background: #6c757d; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: 500; font-size: 14px; display: inline-block;">
                    Reset
                </a>
            @endif
        </form>
    </div>

    @if($search)
        <div style="background: #d1ecf1; border-left: 4px solid #17a2b8; color: #0c5460; padding: 12px 20px; border-radius: 4px; margin-bottom: 20px;">
            <strong>Hasil pencarian untuk:</strong> "{{ $search }}" 
            @if($spareparts->count() > 0)
                ({{ $spareparts->count() }} item ditemukan)
            @endif
        </div>
    @endif

    @if(session('success'))
        <div style="background: #d4edda; border-left: 4px solid #28a745; color: #155724; padding: 15px 20px; border-radius: 4px; margin-bottom: 20px;">
            <strong>Berhasil:</strong> {{ session('success') }}
        </div>
    @endif

    <div style="background: white; border: 1px solid #dee2e6; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <table style="width: 100%; border-collapse: collapse;">
            <thead style="background: #343a40; color: white;">
                <tr>
                    <th style="padding: 15px; text-align: left; font-weight: 600;">No</th>
                    <th style="padding: 15px; text-align: left; font-weight: 600;">Nama Sparepart</th>
                    <th style="padding: 15px; text-align: left; font-weight: 600;">Stok</th>
                    <th style="padding: 15px; text-align: left; font-weight: 600;">Harga</th>
                    <th style="padding: 15px; text-align: left; font-weight: 600;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($spareparts as $sp)
                <tr style="{{ $sp->stok < 10 ? 'background: #fff3cd;' : 'background: white;' }} border-bottom: 1px solid #dee2e6;">
                    <td style="padding: 15px;">{{ $loop->iteration }}</td>
                    <td style="padding: 15px;">
                        <strong style="color: #212529;">{{ $sp->nama_sparepart }}</strong>
                        @if($sp->stok < 10 && $sp->stok > 0)
                            <br><span style="background: #dc3545; color: white; padding: 3px 10px; border-radius: 3px; font-size: 12px; font-weight: 500;">STOK RENDAH</span>
                        @endif
                    </td>
                    <td style="padding: 15px;">
                        <strong style="color: #212529;">{{ $sp->stok }} unit</strong>
                        <br>
                        @if($sp->stok == 0)
                            <span style="color: white; background: #dc3545; padding: 4px 10px; border-radius: 3px; font-size: 12px; font-weight: 500;">Out of Stock</span>
                        @elseif($sp->stok <= 10)
                            <span style="background: #ffc107; color: #212529; padding: 4px 10px; border-radius: 3px; font-size: 12px; font-weight: 500;">Low</span>
                        @else
                            <span style="color: white; background: #28a745; padding: 4px 10px; border-radius: 3px; font-size: 12px; font-weight: 500;">Safe</span>
                        @endif
                    </td>
                    <td style="padding: 15px; color: #212529;">Rp {{ number_format($sp->harga, 0, ',', '.') }}</td>
                    <td style="padding: 15px;">
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('spareparts.edit', $sp->id) }}" style="background: #ffc107; color: #212529; padding: 8px 16px; text-decoration: none; border-radius: 4px; font-size: 14px; font-weight: 500;">Edit</a>
                            <form action="{{ route('spareparts.destroy', $sp->id) }}" method="POST" style="display: inline; margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: #dc3545; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; font-weight: 500;" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 40px; color: #6c757d;">
                        @if($search)
                            <p style="margin: 0; font-size: 16px;">Tidak ada sparepart yang cocok dengan pencarian "{{ $search }}"</p>
                        @else
                            <p style="margin: 0; font-size: 16px;">Belum ada data sparepart</p>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
