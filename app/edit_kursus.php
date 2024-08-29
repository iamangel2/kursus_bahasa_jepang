<?php
include 'db.php';
session_start();

$id = $_GET['id'];
$message = '';
$msg_type = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $durasi = $_POST['durasi'];

    try {
        $stmt = $pdo->prepare("UPDATE kursus SET judul = ?, deskripsi = ?, durasi = ? WHERE id = ?");
        $stmt->execute([$judul, $deskripsi, $durasi, $id]);

        // Set pesan notifikasi berhasil
        $_SESSION['message'] = 'Kursus berhasil diperbarui!';
        $_SESSION['msg_type'] = 'success';

    } catch (PDOException $e) {
        // Set pesan notifikasi gagal
        $_SESSION['message'] = 'Gagal memperbarui kursus: ' . $e->getMessage();
        $_SESSION['msg_type'] = 'danger';
    }

    header('Location: index.php');
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM kursus WHERE id = ?");
$stmt->execute([$id]);
$kursus = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kursus</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Edit Kursus</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="judul">Judul Kursus</label>
                <input type="text" id="judul" name="judul" class="form-control" value="<?php echo htmlspecialchars($kursus['judul']); ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi Kursus</label>
                <textarea id="deskripsi" name="deskripsi" class="form-control" required><?php echo htmlspecialchars($kursus['deskripsi']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="durasi">Durasi (menit)</label>
                <input type="number" id="durasi" name="durasi" class="form-control" value="<?php echo htmlspecialchars($kursus['durasi']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Kursus</button>
        </form>
    </div>
</body>
</html>
