<?php
include 'db.php';

// Ambil ID kursus dari URL
$kursus_id = isset($_GET['kursus_id']) ? (int)$_GET['kursus_id'] : 0;

// Ambil detail kursus
$stmt = $pdo->prepare("SELECT * FROM kursus WHERE id = ?");
$stmt->execute([$kursus_id]);
$kursus = $stmt->fetch();

// Ambil daftar materi untuk kursus tersebut
$stmt = $pdo->prepare("SELECT * FROM materi WHERE kursus_id = ?");
$stmt->execute([$kursus_id]);
$materi = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materi Kursus - <?php echo htmlspecialchars($kursus['judul']); ?></title>
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
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="create_kursus.php">Tambah Kursus Baru</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        <div class="container">
            <h1 class="display-4"><?php echo htmlspecialchars($kursus['judul']); ?></h1>
            <p class="lead"><?php echo htmlspecialchars($kursus['deskripsi']); ?></p>
            <a href="create_materi.php?kursus_id=<?php echo $kursus_id; ?>" class="btn btn-light btn-lg">Tambah Materi Baru</a>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Daftar Materi</h2>
        <div class="row">
            <?php if ($materi): ?>
                <?php foreach ($materi as $m): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card shadow-sm materi-card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($m['judul']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($m['deskripsi']); ?></p>
                            <p class="card-text"><strong>Link Embed:</strong> <a href="<?php echo htmlspecialchars($m['link_embed']); ?>" target="_blank"><?php echo htmlspecialchars($m['link_embed']); ?></a></p>
                            <a href="edit_materi.php?id=<?php echo $m['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_materi.php?id=<?php echo $m['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus materi ini?');">Hapus</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-center">Belum ada materi untuk kursus ini.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2024 Kursus Bahasa Jepang. Semua hak dilindungi.</p>
    </footer>
</body>
</html>
