<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "mlbb";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

$nama = isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : '';
$player_id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : '';
$skin = isset($_POST['skin']) ? htmlspecialchars($_POST['skin']) : '';

if (!$nama || !$player_id || !$skin) {
  echo "Data tidak lengkap!";
  exit;
}

$stmt = $conn->prepare("INSERT INTO skin_claims (nama, player_id, skin) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nama, $player_id, $skin);
$stmt->execute();


$stmt->close();
$conn->close();

// Pastikan semua field telah diisi
$nama = $_POST['nama'] ?? '';
$id = $_POST['id'] ?? '';
$skin = $_POST['skin'] ?? '';

if (empty($nama) || empty($id) || empty($skin)) {
    echo "<h2 style='color:red; text-align:center;'>Semua data harus diisi!</h2>";
    exit;
}

// Cegah input berbahaya
$nama = htmlspecialchars($nama, ENT_QUOTES, 'UTF-8');
$id = htmlspecialchars($id, ENT_QUOTES, 'UTF-8');
$skin = htmlspecialchars($skin, ENT_QUOTES, 'UTF-8');
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hasil Klaim</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url(img/bg.jpg);
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      font-family: 'Segoe UI', sans-serif;
    }
    .result-card {
      background: #1e1e1e;
      padding: 2rem;
      border-radius: 1rem;
      text-align: center;
      box-shadow: 0 0 15px #00ffcc;
    }
    img.skin-img {
      width: 120px;
      border-radius: 10px;
      margin-bottom: 1rem;
    }
  </style>
</head>
<body>
  <div class="result-card">
    <h2>Terima kasih <?= $nama; ?>!</h2>
    <p>ID Kamu: <strong><?= $id; ?></strong></p>
    <p>Kamu mendapatkan skin:</p>
    <img src="img/<?= strtolower($skin); ?>.png" alt="<?= $skin; ?>" class="skin-img">
    <h3><?= $skin; ?></h3>
    <p>Hadiah akan segera dikirim ke id kamu!</p>
  </div>
</body>
</html>
