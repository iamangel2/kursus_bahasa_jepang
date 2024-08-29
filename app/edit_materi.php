<?php
include 'db.php';
session_start();

$id = $_GET['id'];
$message = '';
$msg_type = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $link_embed = $_POST['link_embed'];

    try {
        $stmt = $pdo->prepare("UPDATE materi SET judul = ?, deskripsi = ?, link_embed = ? WHERE id = ?");
        $stmt->execute([$judul, $deskripsi, $link_embed, $id]);

        // Set pesan notifikasi berhasil
        $_SESSION['message'] = 'Materi berhasil diperbarui!';
        $_SESSION['msg_type'] = 'success';

    } catch (PDOException $e) {
        // Set pesan notifikasi gagal
        $_SESSION['message'] = 'Gagal memperbarui materi: ' . $e->getMessage();
        $_SESSION['msg_type'] = 'danger';
    }

    header('Location: index.php');
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM materi WHERE id = ?");
$stmt->execute([$id]);
$materi = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Materi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Edit Materi</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="judul">Judul Materi</label>
                <input type="text" id="judul" name="judul" class="form-control" value="<?php echo htmlspecialchars($materi['judul']); ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi Materi</label>
                <textarea id="deskripsi" name="deskripsi" class="form-control" required><?php echo htmlspecialchars($materi['deskripsi']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="link_embed">Link Embed Materi</label>
                <input type="text" id="link_embed" name="link_embed" class="form-control" value="<?php echo htmlspecialchars($materi['link_embed']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Materi</button>
        </form>
    </div>
</body>
</html>
