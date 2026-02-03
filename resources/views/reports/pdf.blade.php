<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Gudang Sparepart</title>
    <style>
        body { font-family: 'DejaVu Sans', Arial, sans-serif; font-size: 11px; color: #333; line-height: 1.4; }
        h1 { font-size: 22px; color: #2c3e50; text-align: center; margin: 0 0 5px 0; font-weight: bold; }
        h2 { font-size: 14px; color: #2c3e50; margin: 15px 0 8px 0; border-bottom: 2px solid #3498db; padding-bottom: 5px; font-weight: bold; }
        .subtitle { text-align: center; color: #6c757d; margin: 0 0 20px 0; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th { background: #343a40; color: white; padding: 8px 10px; text-align: left; font-weight: 600; font-size: 11px; }
        td { padding: 7px 10px; border-bottom: 1px solid #dee2e6; font-size: 10px; }
        tr:nth-child(even) { background: #f8f9fa; }
        .stats { width: 100%; margin-bottom: 20px; border-collapse: collapse; }
        .stats td { padding: 12px; text-align: center; color: white; font-weight: bold; border: none; }
        .stats .label { font-size: 9px; opacity: 0.9; display: block; margin-bottom: 3px; }
        .stats .value { font-size: 20px; display: block; }
        .blue { background: #3498db; }
        .green { background: #28a745; }
        .red { background: #dc3545; }
        .yellow { background: #ffc107; color: #212529 !important; }
        .badge { padding: 3px 8px; border-radius: 3px; font-size: 9px; font-weight: bold; display: inline-block; }
        .badge-in { background: #28a745; color: white; }
        .badge-out { background: #dc3545; color: white; }
        .badge-low { background: #dc3545; color: white; }
        .highlight { background: #fff3cd !important; }
        .footer { text-align: center; margin-top: 20px; padding-top: 10px; border-top: 1px solid #dee2e6; color: #6c757d; font-size: 9px; }
        .date-cell { font-size: 10px; }
        .time-cell { font-size: 9px; color: #6c757d; }
    </style>
</head>
<body>
    <h1>LAPORAN GUDANG SPAREPART KOMPUTER</h1>
    <p class="subtitle">Periode: {{ \Carbon\Carbon::parse($startDate)->locale('id')->isoFormat('DD MMMM YYYY') }} - {{ \Carbon\Carbon::parse($endDate)->locale('id')->isoFormat('DD MMMM YYYY') }}</p>

    <!-- Statistics -->
    <table class="stats">
        <tr>
            <td class="blue">
                <span class="label">Total Transaksi</span>
                <span class="value">{{ $totalTransactions }}</span>
            </td>
            <td class="green">
                <span class="label">Barang Masuk</span>
                <span class="value">{{ $transactionsIn }}</span>
            </td>
            <td class="red">
                <span class="label">Barang Keluar</span>
                <span class="value">{{ $transactionsOut }}</span>
            </td>
            <td class="yellow">
                <span class="label">Nilai Total Stok</span>
                <span class="value" style="font-size: 14px;">Rp {{ number_format($totalStockValue, 0, ',', '.') }}</span>
            </td>
        </tr>
    </table>

    <!-- Transactions -->
    <h2>Riwayat Transaksi</h2>
    <table>
        <thead>
            <tr>
                <th style="width: 15%;">Tanggal</th>
                <th style="width: 30%;">Sparepart</th>
                <th style="width: 10%;">Tipe</th>
                <th style="width: 10%;">Jumlah</th>
                <th style="width: 35%;">Catatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $tr)
            <tr>
                <td class="date-cell">
                    {{ \Carbon\Carbon::parse($tr->created_at)->locale('id')->isoFormat('DD MMM YYYY') }}<br>
                    <span class="time-cell">{{ \Carbon\Carbon::parse($tr->created_at)->format('H:i') }} WIB</span>
                </td>
                <td><strong>{{ $tr->sparepart->nama_sparepart }}</strong></td>
                <td style="text-align: center;">
                    @if($tr->type === 'in')
                        <span class="badge badge-in">MASUK</span>
                    @else
                        <span class="badge badge-out">KELUAR</span>
                    @endif
                </td>
                <td style="text-align: center;"><strong>{{ $tr->quantity }}</strong></td>
                <td>{{ $tr->note ?: '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 20px; color: #6c757d;">
                    Tidak ada transaksi pada periode ini
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Current Stock -->
    <h2>Stok Saat Ini</h2>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 35%;">Nama Sparepart</th>
                <th style="width: 15%;">Stok</th>
                <th style="width: 20%;">Harga</th>
                <th style="width: 25%;">Nilai Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($spareparts as $sp)
            <tr class="{{ $sp->stok < 10 ? 'highlight' : '' }}">
                <td>{{ $loop->iteration }}</td>
                <td><strong>{{ $sp->nama_sparepart }}</strong></td>
                <td>
                    {{ $sp->stok }} unit
                    @if($sp->stok < 10)
                        <span class="badge badge-low">RENDAH</span>
                    @endif
                </td>
                <td>Rp {{ number_format($sp->harga, 0, ',', '.') }}</td>
                <td><strong>Rp {{ number_format($sp->stok * $sp->harga, 0, ',', '.') }}</strong></td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 20px; color: #6c757d;">
                    Tidak ada data sparepart
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p style="margin: 0 0 3px 0;"><strong>Sistem Informasi Gudang Sparepart Komputer</strong></p>
        <p style="margin: 0;">Dicetak pada: {{ \Carbon\Carbon::now()->locale('id')->isoFormat('DD MMMM YYYY [pukul] HH:mm') }} WIB</p>
    </div>
</body>
</html>
