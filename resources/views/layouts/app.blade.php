<!DOCTYPE html>
<html>
<head>
    <title>Gudang Sparepart</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .wrapper {
            display: flex;
            height: 100vh;
        }
        .sidebar {
            width: 220px;
            background: #1f2937;
            color: white;
            padding: 20px;
        }
        .sidebar h2 {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            margin-bottom: 10px;
            padding: 8px;
            border-radius: 4px;
        }
        .sidebar a:hover {
            background: #374151;
        }
        .content {
            flex: 1;
            padding: 20px;
            background: #f3f4f6;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
    <h2>Gudang</h2>

    <a href="{{ route('dashboard') }}">
        📊 Dashboard
    </a>

    <a href="{{ route('spareparts.index') }}">
        📦 Data Sparepart
    </a>

    <a href="{{ route('transactions.index') }}">
        🔄 Transaksi
    </a>

    <a href="{{ route('notifications.settings') }}">
        📧 Notifikasi
    </a>

    <a href="{{ route('reports.index') }}">
        📊 Laporan
    </a>
</div>


    <div class="content">
        @yield('content')
    </div>
</div>

</body>
</html>
