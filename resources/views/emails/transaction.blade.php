<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, {{ $transaction->type === 'in' ? '#059669' : '#dc2626' }} 0%, {{ $transaction->type === 'in' ? '#10b981' : '#ef4444' }} 100%); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .header h1 { margin: 0; font-size: 24px; }
        .content { background: #f9fafb; padding: 30px; border: 1px solid #e5e7eb; }
        .transaction-box { background: {{ $transaction->type === 'in' ? '#ecfdf5' : '#fef2f2' }}; border-left: 4px solid {{ $transaction->type === 'in' ? '#059669' : '#dc2626' }}; padding: 15px; margin: 20px 0; border-radius: 4px; }
        .info-table { width: 100%; margin: 20px 0; background: white; border-radius: 8px; overflow: hidden; }
        .info-table tr { border-bottom: 1px solid #e5e7eb; }
        .info-table tr:last-child { border-bottom: none; }
        .info-table td { padding: 12px 15px; }
        .info-table td:first-child { font-weight: bold; color: #6b7280; width: 40%; }
        .badge { display: inline-block; padding: 5px 15px; background: {{ $transaction->type === 'in' ? '#059669' : '#dc2626' }}; color: white; border-radius: 20px; font-size: 14px; font-weight: bold; }
        .footer { text-align: center; margin-top: 20px; padding-top: 20px; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $transaction->type === 'in' ? 'BARANG MASUK' : 'BARANG KELUAR' }}</h1>
    </div>
    
    <div class="content">
        <div class="transaction-box">
            <strong>TRANSAKSI BERHASIL</strong><br>
            Transaksi {{ $transaction->type === 'in' ? 'barang masuk' : 'barang keluar' }} telah berhasil diproses.
        </div>

        <table class="info-table">
            <tr>
                <td>Jenis Transaksi</td>
                <td><span class="badge">{{ $transaction->type === 'in' ? 'BARANG MASUK' : 'BARANG KELUAR' }}</span></td>
            </tr>
            <tr>
                <td>Sparepart</td>
                <td><strong>{{ $transaction->sparepart->nama_sparepart }}</strong></td>
            </tr>
            <tr>
                <td>Jumlah</td>
                <td><strong>{{ $transaction->quantity }} unit</strong></td>
            </tr>
            <tr>
                <td>Harga Satuan</td>
                <td>Rp {{ number_format($transaction->sparepart->harga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Nilai</td>
                <td><strong>Rp {{ number_format($transaction->quantity * $transaction->sparepart->harga, 0, ',', '.') }}</strong></td>
            </tr>
            <tr>
                <td>Stok Sekarang</td>
                <td><strong>{{ $transaction->sparepart->stok }} unit</strong></td>
            </tr>
            @if($transaction->note)
            <tr>
                <td>Catatan</td>
                <td>{{ $transaction->note }}</td>
            </tr>
            @endif
            <tr>
                <td>Waktu</td>
                <td>{{ $transaction->created_at->format('d/m/Y H:i:s') }}</td>
            </tr>
        </table>

        @if($transaction->type === 'out' && $transaction->sparepart->stok < 10)
        <div style="background: #fef2f2; border: 1px solid #fca5a5; padding: 15px; border-radius: 5px;">
            <strong>Peringatan Stok Rendah</strong><br>
            Stok sparepart ini sudah rendah ({{ $transaction->sparepart->stok }} unit). Pertimbangkan restock.
        </div>
        @endif
    </div>

    <div class="footer">
        <strong>Gudang Sparepart System</strong><br>
        Automated Notification<br>
        {{ date('d/m/Y H:i:s') }}
    </div>
</body>
</html>
