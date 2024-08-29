<?php
include 'db.php';
session_start();

$id = $_GET['id'];

try {
    $stmt = $pdo->prepare("DELETE FROM kursus WHERE id = ?");
    $stmt->execute([$id]);

    // Set pesan notifikasi berhasil
    $_SESSION['message'] = 'Kursus berhasil dihapus!';
    $_SESSION['msg_type'] = 'success';

} catch (PDOException $e) {
    // Set pesan notifikasi gagal
    $_SESSION['message'] = 'Gagal menghapus kursus: ' . $e->getMessage();
    $_SESSION['msg_type'] = 'danger';
}

header('Location: index.php');
exit();
?>
