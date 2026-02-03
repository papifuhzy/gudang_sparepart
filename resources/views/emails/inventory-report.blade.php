<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 800px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .header h1 { margin: 0; font-size: 28px; }
        .summary {background: white; padding: 20px; display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; border-bottom: 1px solid #e5e7eb; }
        .summary-card { text-align: center; padding: 15px; background: #f9fafb; border-radius: 8px; }
        .summary-card .number { font-size: 32px; font-weight: bold; color: #2563eb; }
        .summary-card .label { color: #6b7280; font-size: 14px; margin-top: 5px; }
        .content { background: #f9fafb; padding: 30px; border: 1px solid #e5e7eb; }
        .inventory-table { width: 100%; background: white; border-radius: 8px; overflow: hidden; margin: 20px 0; border-collapse: collapse; }
        .inventory-table thead { background: #2563eb; color: white; }
        .inventory-table th { padding: 12px; text-align: left; font-weight: 600; }
        .inventory-table td { padding: 12px; border-bottom: 1px solid #e5e7eb; }
        .low-stock { background: #fef2f2 !important; }
        .badge-low { background: #dc2626; color: white; padding: 3px 10px; border-radius: 12px; font-size: 11px; font-weight: bold; }
        .badge-ok { background: #059669; color: white; padding: 3px 10px; border-radius: 12px; font-size: 11px; font-weight: bold; }
        .footer { text-align: center; margin-top: 20px; padding-top: 20px; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>📊 LAPORAN INVENTORI</h1>
        <p style="margin: 10px 0 0 0; font-size: 14px;">{{ date('d F Y') }}</p>
    </div>

    <div class="summary">
        <div class="summary-card">
            <div class="number">{{ $spareparts->count() }}</div>
            <div class="label">Total Item</div>
        </div>
        <div class="summary-card">
            <div class="number">{{ $lowStockCount }}</div>
            <div class="label">Stok Rendah</div>
        </div>
        <div class="summary-card">
            <div class="number">Rp {{ number_format($totalValue, 0, ',', '.') }}</div>
            <div class="label">Total Nilai</div>
        </div>
    </div>
    
    <div class="content">
        <h3>Daftar Sparepart</h3>
        
        <table class="inventory-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($spareparts as $index => $sp)
                <tr class="{{ $sp->stok <  10 ? 'low-stock' : '' }}">
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $sp->nama_sparepart }}</strong></td>
                    <td>{{ $sp->stok }} unit</td>
                    <td>Rp {{ number_format($sp->harga, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($sp->stok * $sp->harga, 0, ',', '.') }}</td>
                    <td>
                        @if($sp->stok < 10)
                            <span class="badge-low">RENDAH</span>
                        @else
                            <span class="badge-ok">OK</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($lowStockCount > 0)
        <div style="background: #fef2f2; border: 1px solid #fca5a5; padding: 15px; border-radius: 5px;">
            <strong>⚠️ Peringatan</strong><br>
            {{ $lowStockCount }} item dengan stok rendah memerlukan restock.
        </div>
        @endif
    </div>

    <div class="footer">
        <strong>Gudang Sparepart System</strong><br>
        {{ date('d/m/Y H:i:s') }}
    </div>
</body>
</html>
