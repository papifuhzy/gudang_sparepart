@extends('layouts.app')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 20px;">
    <div style="margin-bottom: 30px;">
        <h2 style="margin: 0; color: #2c3e50;">Dashboard Gudang</h2>
        <p style="color: #6c757d; margin: 5px 0 0 0;">Ringkasan statistik inventori sparepart</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
        <!-- Total Sparepart Card -->
        <div style="background: linear-gradient(135deg, #3498db 0%, #2980b9 100%); border-radius: 8px; padding: 30px; color: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                <div>
                    <p style="margin: 0; font-size: 14px; opacity: 0.9; font-weight: 500;">Total Jenis Sparepart</p>
                    <h2 style="margin: 10px 0 0 0; font-size: 42px; font-weight: bold;">{{ $totalSparepart }}</h2>
                </div>
                <div style="background: rgba(255,255,255,0.2); padding: 15px; border-radius: 50%; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                    <span style="font-size: 24px;">📦</span>
                </div>
            </div>
            <p style="margin: 0; font-size: 13px; opacity: 0.8;">Jenis item terdaftar</p>
        </div>

        <!-- Total Stok Card -->
        <div style="background: linear-gradient(135deg, #28a745 0%, #218838 100%); border-radius: 8px; padding: 30px; color: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                <div>
                    <p style="margin: 0; font-size: 14px; opacity: 0.9; font-weight: 500;">Total Stok</p>
                    <h2 style="margin: 10px 0 0 0; font-size: 42px; font-weight: bold;">{{ $totalStok }}</h2>
                </div>
                <div style="background: rgba(255,255,255,0.2); padding: 15px; border-radius: 50%; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                    <span style="font-size: 24px;">📊</span>
                </div>
            </div>
            <p style="margin: 0; font-size: 13px; opacity: 0.8;">Unit tersedia</p>
        </div>

        <!-- Critical Stock Card -->
        <div style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); border-radius: 8px; padding: 30px; color: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                <div>
                    <p style="margin: 0; font-size: 14px; opacity: 0.9; font-weight: 500;">Stok Rendah</p>
                    <h2 style="margin: 10px 0 0 0; font-size: 42px; font-weight: bold;">{{ $criticalStock }}</h2>
                </div>
                <div style="background: rgba(255,255,255,0.2); padding: 15px; border-radius: 50%; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                    <span style="font-size: 24px;">⚠</span>
                </div>
            </div>
            <p style="margin: 0; font-size: 13px; opacity: 0.8;">Item perlu restock</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div style="background: white; border: 1px solid #dee2e6; border-radius: 8px; padding: 25px; margin-top: 30px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <h3 style="margin: 0 0 20px 0; color: #2c3e50; font-size: 18px;">Akses Cepat</h3>
        <div style="display: flex; flex-wrap: wrap; gap: 15px;">
            <a href="{{ route('spareparts.index') }}" style="background: #3498db; color: white; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: 500; display: inline-flex; align-items: center; gap: 8px;">
                Kelola Sparepart
            </a>
            <a href="{{ route('transactions.index') }}" style="background: #28a745; color: white; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: 500; display: inline-flex; align-items: center; gap: 8px;">
                Transaksi
            </a>
            <a href="{{ route('notifications.settings') }}" style="background: #17a2b8; color: white; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: 500; display: inline-flex; align-items: center; gap: 8px;">
                Notifikasi Email
            </a>
        </div>
    </div>
</div>
@endsection
