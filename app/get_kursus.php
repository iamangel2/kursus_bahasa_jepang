<?php
header('Content-Type: application/json');

// Koneksi database
include 'db.php';

// Query untuk mengambil data kursus
$sql = "SELECT * FROM kursus";
$result = mysqli_query($conn, $sql);

$kursus = array();

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $kursus[] = $row;
    }
}

mysqli_close($conn);

echo json_encode($kursus);
?>
