<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .header h1 { margin: 0; font-size: 24px; }
        .content { background: #f9fafb; padding: 30px; border: 1px solid #e5e7eb; }
        .alert-box { background: #fef2f2; border-left: 4px solid #dc2626; padding: 15px; margin: 20px 0; border-radius: 4px; }
        .info-table { width: 100%; margin: 20px 0; background: white; border-radius: 8px; overflow: hidden; }
        .info-table tr { border-bottom: 1px solid #e5e7eb; }
        .info-table tr:last-child { border-bottom: none; }
        .info-table td { padding: 12px 15px; }
        .info-table td:first-child { font-weight: bold; color: #6b7280; width: 40%; }
        .badge { display: inline-block; padding: 5px 15px; background: #dc2626; color: white; border-radius: 20px; font-size: 14px; font-weight: bold; }
        .footer { text-align: center; margin-top: 20px; padding-top: 20px; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>ALERT STOK RENDAH</h1>
    </div>
    
    <div class="content">
        <div class="alert-box">
            <strong>PERHATIAN!</strong><br>
            Stok sparepart berikut telah mencapai level rendah dan memerlukan restock segera.
        </div>

        <table class="info-table">
            <tr>
                <td>Nama Sparepart</td>
                <td><strong>{{ $sparepart->nama_sparepart }}</strong></td>
            </tr>
            <tr>
                <td>Stok Tersisa</td>
                <td><span class="badge">{{ $sparepart->stok }} unit</span></td>
            </tr>
            <tr>
                <td>Harga Satuan</td>
                <td>Rp {{ number_format($sparepart->harga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Nilai</td>
                <td>Rp {{ number_format($sparepart->stok * $sparepart->harga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Tanggal Alert</td>
                <td>{{ date('d/m/Y H:i:s') }}</td>
            </tr>
        </table>

        <p><strong>Tindakan Diperlukan:</strong><br>Harap lakukan pemesanan ulang sesegera mungkin.</p>
    </div>

    <div class="footer">
        <strong>Gudang Sparepart System</strong><br>
        Automated Notification<br>
        {{ date('d/m/Y H:i:s') }}
    </div>
</body>
</html>
