<?php
include 'db.php';

// Ambil daftar kursus dari database
$stmt = $pdo->query("SELECT * FROM kursus");
$kursus = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kursus Bahasa Jepang</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Kursus Bahasa Jepang</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        <div class="container">
            <h1 class="display-4">Belajar Bahasa Jepang</h1>
            <p class="lead">Temukan kursus bahasa Jepang terbaik untuk memulai perjalanan belajar Anda.</p>
            <a href="create_kursus.php" class="btn btn-light btn-lg">Tambah Kursus Baru</a>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Daftar Kursus</h2>
        <div class="row">
            <?php foreach ($kursus as $k): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm kursus-card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($k['judul']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($k['deskripsi']); ?></p>
                        <p class="card-text"><strong>Durasi:</strong> <?php echo htmlspecialchars($k['durasi']); ?> menit</p>
                        <div class="btn-group">
                            <a href="edit_kursus.php?id=<?php echo $k['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_kursus.php?id=<?php echo $k['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kursus ini?');">Hapus</a>
                            <a href="create_materi.php?kursus_id=<?php echo $k['id']; ?>" class="btn btn-info btn-sm">Tambah Materi</a>
                            <a href="materi.php?kursus_id=<?php echo $k['id']; ?>" class="btn btn-secondary btn-sm">Lihat Materi</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2024 Kursus Bahasa Jepang. Semua hak dilindungi.</p>
    </footer>
</body>
</html>
