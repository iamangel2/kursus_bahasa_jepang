<?php
include 'db.php';
session_start();

// Periksa apakah ada pesan notifikasi di session
$message = '';
$msg_type = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $durasi = $_POST['durasi'];

    try {
        $stmt = $pdo->prepare("INSERT INTO kursus (judul, deskripsi, durasi) VALUES (?, ?, ?)");
        $stmt->execute([$judul, $deskripsi, $durasi]);

        // Set pesan notifikasi berhasil
        $_SESSION['message'] = 'Kursus berhasil ditambahkan!';
        $_SESSION['msg_type'] = 'success';

    } catch (PDOException $e) {
        // Set pesan notifikasi gagal
        $_SESSION['message'] = 'Gagal menambahkan kursus: ' . $e->getMessage();
        $_SESSION['msg_type'] = 'danger';
    }

    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kursus</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Tambah Kursus</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="judul">Judul Kursus</label>
                <input type="text" id="judul" name="judul" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi Kursus</label>
                <textarea id="deskripsi" name="deskripsi" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="durasi">Durasi (menit)</label>
                <input type="number" id="durasi" name="durasi" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Kursus</button>
        </form>
    </div>
</body>
</html>
