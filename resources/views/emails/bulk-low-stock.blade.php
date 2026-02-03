<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 700px; margin: 0 auto; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: white; padding: 30px 25px; text-align: center; }
        .header h1 { margin: 0 0 8px 0; font-size: 26px; }
        .header p { margin: 0; opacity: 0.9; font-size: 14px; }
        .content { padding: 30px 25px; }
        .alert-box { background: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; border-radius: 4px; margin-bottom: 25px; }
        .alert-box strong { color: #856404; }
        .alert-box p { margin: 5px 0 0 0; color: #856404; }
        .stats { display: flex; gap: 15px; margin-bottom: 25px; }
        .stat-card { flex: 1; background: #f8f9fa; padding: 20px; border-radius: 6px; text-align: center; border: 1px solid #dee2e6; }
        .stat-card .label { font-size: 12px; color: #6c757d; margin-bottom: 5px; }
        .stat-card .value { font-size: 28px; font-weight: bold; color: #dc3545; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { background: #343a40; color: white; padding: 12px; text-align: left; font-size: 13px; font-weight: 600; }
        td { padding: 12px; border-bottom: 1px solid #dee2e6; font-size: 14px; }
        tr:nth-child(even) { background: #f8f9fa; }
        tr.critical { background: #f8d7da !important; }
        .badge { display: inline-block; padding: 4px 10px; border-radius: 3px; font-size: 11px; font-weight: bold; }
        .badge-critical { background: #dc3545; color: white; }
        .badge-low { background: #ffc107; color: #212529; }
        .footer { background: #f8f9fa; padding: 20px 25px; text-align: center; border-top: 1px solid #dee2e6; }
        .footer p { margin: 0; color: #6c757d; font-size: 12px; }
        .action-btn { display: inline-block; background: #dc3545; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; margin-top: 15px; font-weight: 500; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>⚠️ Peringatan Stok Rendah</h1>
            <p>Laporan Inventori Gudang Sparepart</p>
        </div>
        
        <div class="content">
            <div class="alert-box">
                <strong>Perhatian!</strong>
                <p>Terdapat {{ $spareparts->count() }} item sparepart dengan stok di bawah ambang batas minimum (10 unit)</p>
            </div>

            <div class="stats">
                <div class="stat-card">
                    <div class="label">Total Item</div>
                    <div class="value">{{ $spareparts->count() }}</div>
                </div>
                <div class="stat-card">
                    <div class="label">Stok Kritis (< 5)</div>
                    <div class="value">{{ $spareparts->where('stok', '<', 5)->count() }}</div>
                </div>
                <div class="stat-card">
                    <div class="label">Total Kekurangan</div>
                    <div class="value">{{ $spareparts->sum(fn($sp) => max(0, 10 - $sp->stok)) }}</div>
                </div>
            </div>

            <h3 style="margin: 0 0 10px 0; color: #2c3e50; font-size: 18px;">Daftar Sparepart Stok Rendah</h3>
            
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 50%;">Nama Sparepart</th>
                        <th style="width: 20%;">Stok Tersedia</th>
                        <th style="width: 25%;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($spareparts as $sp)
                    <tr class="{{ $sp->stok < 5 ? 'critical' : '' }}">
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $sp->nama_sparepart }}</strong></td>
                        <td style="font-weight: bold; color: #dc3545;">{{ $sp->stok }} unit</td>
                        <td>
                            @if($sp->stok < 5)
                                <span class="badge badge-critical">KRITIS</span>
                            @else
                                <span class="badge badge-low">RENDAH</span>
                            @endif
                            <small style="color: #6c757d; display: block; margin-top: 4px;">
                                Butuh {{ 10 - $sp->stok }} unit lagi
                            </small>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="margin-top: 25px; padding: 15px; background: #e7f3ff; border-left: 4px solid #3498db; border-radius: 4px;">
                <strong style="color: #004085;">💡 Rekomendasi:</strong>
                <p style="margin: 5px 0 0 0; color: #004085;">
                    Segera lakukan pemesanan atau restock untuk item-item di atas agar operasional gudang tidak terganggu.
                </p>
            </div>
        </div>
        
        <div class="footer">
            <p><strong>Sistem Informasi Gudang Sparepart Komputer</strong></p>
            <p>Email otomatis dikirim pada: {{ \Carbon\Carbon::now()->locale('id')->isoFormat('DD MMMM YYYY [pukul] HH:mm') }} WIB</p>
        </div>
    </div>
</body>
</html>
