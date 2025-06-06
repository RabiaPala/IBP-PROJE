<?php
// Kullanıcının araç kiralama işlemleri.
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
require 'includes/db.php';

// Kiralama işlemi
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vehicle_id = $_POST['vehicle_id'];
    $user_id = $_SESSION['user_id'];
    $rent_date = $_POST['rent_date'];
    $return_date = $_POST['return_date'];

    $stmt = $pdo->prepare("INSERT INTO rentals (user_id, vehicle_id, rent_date, return_date) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$user_id, $vehicle_id, $rent_date, $return_date])) {
        $msg = "Araç başarıyla kiralandı.";
    } else {
        $msg = "Kiralama işlemi başarısız.";
    }
}

$vehicles = $pdo->query("SELECT * FROM vehicles WHERE available = 1")->fetchAll();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Araç Kiralama</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Araç Kirala</h2>
    <?php if ($msg): ?>
        <p style="color:green;"> <?= $msg ?> </p>
    <?php endif; ?>

    <form method="POST">
        <label>Araç Seçin:</label>
        <select name="vehicle_id" required>
            <?php foreach ($vehicles as $v): ?>
                <option value="<?= $v['id'] ?>">
                    <?= $v['brand'] ?> - <?= $v['model'] ?> (<?= $v['price'] ?>₺)
                </option>
            <?php endforeach; ?>
        </select><br>
        <label>Başlangıç Tarihi:</label>
        <input type="date" name="rent_date" required><br>
        <label>Bitiş Tarihi:</label>
        <input type="date" name="return_date" required><br>
        <button type="submit">Kirala</button>
    </form>
    <p><a href="dashboard.php">Geri Dön</a></p>
</body>
</html>

<!-- Açıklama: Kullanıcının sistemdeki uygun araçları seçerek kiralayabildiği sayfa. Tarih girerek araç rezervasyonu yapılır. -->
