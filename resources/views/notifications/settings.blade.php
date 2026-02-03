@extends('layouts.app')

@section('content')
<div style="max-width: 900px; margin: 0 auto; padding: 20px;">
    <div style="margin-bottom: 30px;">
        <h2 style="margin: 0; color: #2c3e50;">Pengaturan Notifikasi Email</h2>
        <p style="color: #6c757d; margin: 5px 0 0 0;">Kelola notifikasi email otomatis untuk sistem gudang sparepart</p>
    </div>

    @if(session('success'))
        <div style="background: #d4edda; border-left: 4px solid #28a745; color: #155724; padding: 15px 20px; border-radius: 4px; margin: 20px 0;">
            <strong>Berhasil:</strong> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: #f8d7da; border-left: 4px solid #dc3545; color: #721c24; padding: 15px 20px; border-radius: 4px; margin: 20px 0;">
            <strong>Error:</strong> {{ session('error') }}
        </div>
    @endif

    @if(session('info'))
        <div style="background: #d1ecf1; border-left: 4px solid #17a2b8; color: #0c5460; padding: 15px 20px; border-radius: 4px; margin: 20px 0;">
            <strong>Info:</strong> {{ session('info') }}
        </div>
    @endif

    <!-- Email Configuration Card -->
    <div style="background: white; border: 1px solid #dee2e6; border-radius: 8px; padding: 30px; margin-bottom: 25px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <h3 style="margin-top: 0; color: #2c3e50; font-size: 18px; border-bottom: 2px solid #3498db; padding-bottom: 10px; margin-bottom: 20px;">Konfigurasi Email</h3>
        
        <table style="width: 100%; border-collapse: collapse;">
            <tr style="border-bottom: 1px solid #f1f3f5;">
                <td style="padding: 12px 0; font-weight: 600; width: 35%; color: #495057;">Email Penerima</td>
                <td style="padding: 12px 0; color: #212529;">{{ $email }}</td>
            </tr>
            <tr style="border-bottom: 1px solid #f1f3f5;">
                <td style="padding: 12px 0; font-weight: 600; color: #495057;">Threshold Stok Rendah</td>
                <td style="padding: 12px 0; color: #212529;">{{ $threshold }} unit</td>
            </tr>
            <tr>
                <td style="padding: 12px 0; font-weight: 600; color: #495057;">Status Notifikasi</td>
                <td style="padding: 12px 0;">
                    <span style="background: #28a745; color: white; padding: 4px 12px; border-radius: 3px; font-size: 13px; font-weight: 500;">Aktif</span>
                </td>
            </tr>
        </table>
    </div>

    <!-- Quick Actions Card -->
    <div style="background: white; border: 1px solid #dee2e6; border-radius: 8px; padding: 30px; margin-bottom: 25px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <h3 style="margin-top: 0; color: #2c3e50; font-size: 18px; border-bottom: 2px solid #3498db; padding-bottom: 10px; margin-bottom: 20px;">Tindakan Cepat</h3>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 15px;">
            <!-- Test Email -->
            <form action="{{ route('notifications.test-email') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" style="width: 100%; background: #28a745; color: white; padding: 15px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: 500; font-size: 15px; transition: background 0.3s; display: flex; align-items: center; justify-content: center; gap: 8px;">
                    <span>Test Email</span>
                </button>
            </form>

            <!-- Send Report -->
            <form action="{{ route('notifications.send-report') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" style="width: 100%; background: #17a2b8; color: white; padding: 15px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: 500; font-size: 15px; transition: background 0.3s; display: flex; align-items: center; justify-content: center; gap: 8px;">
                    <span>Kirim Laporan Inventori</span>
                </button>
            </form>

            <!-- Check Low Stock -->
            <form action="{{ route('notifications.check-low-stock') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" style="width: 100%; background: #ffc107; color: #212529; padding: 15px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: 500; font-size: 15px; transition: background 0.3s; display: flex; align-items: center; justify-content: center; gap: 8px;">
                    <span>Cek Stok Rendah</span>
                </button>
            </form>
        </div>
    </div>

    <!-- API Info Card -->
    <div style="background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px; padding: 25px;">
        <h4 style="margin-top: 0; color: #495057; font-size: 16px; margin-bottom: 15px;">Informasi API</h4>
        <div style="color: #6c757d; font-size: 14px; line-height: 1.6;">
            <p style="margin: 0 0 10px 0;">
                <strong style="color: #495057;">Service:</strong> Gmail SMTP<br>
                <strong style="color: #495057;">Email:</strong> {{ $email }}
            </p>
            <p style="margin: 0;">
                <strong style="color: #495057;">Dokumentasi:</strong> <code style="background: #e9ecef; padding: 2px 6px; border-radius: 3px;">config/api_gmail.json</code><br>
                <small>Berisi credentials dan setup instructions</small>
            </p>
        </div>
    </div>

    <div style="margin-top: 25px; text-align: center;">
        <a href="{{ route('spareparts.index') }}" style="color: #3498db; text-decoration: none; font-weight: 500;">
            ← Kembali ke Daftar Sparepart
        </a>
    </div>
</div>

<style>
    button:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }
    button:active {
        transform: translateY(0);
    }
</style>
@endsection
