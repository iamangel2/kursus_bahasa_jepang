document.addEventListener('DOMContentLoaded', function() {
    loadKursus();

    // Konfirmasi penghapusan
    const deleteButtons = document.querySelectorAll('.btn-danger');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            if (!confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                event.preventDefault();
            }
        });
    });
});

function loadKursus() {
    fetch('app/get_kursus.php')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('kursus-container');
            container.innerHTML = ''; // Clear existing content
            data.forEach(kursus => {
                const kursusCard = `
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card kursus-card">
                            <div class="card-body">
                                <h5 class="card-title">${kursus.judul}</h5>
                                <p class="card-text">${kursus.deskripsi}</p>
                                <p class="card-text"><strong>Durasi:</strong> ${kursus.durasi} menit</p>
                                <a href="app/edit_kursus.html?id=${kursus.id}" class="btn btn-warning btn-sm">Edit</a>
                                <a href="app/delete_kursus.php?id=${kursus.id}" class="btn btn-danger btn-sm">Hapus</a>
                                <a href="app/create_materi.html?kursus_id=${kursus.id}" class="btn btn-info btn-sm">Tambah Materi</a>
                            </div>
                        </div>
                    </div>
                `;
                container.innerHTML += kursusCard;
            });
        })
        .catch(error => console.error('Error loading kursus:', error));
}

// Tambahkan event listener ke semua link dengan kelas 'btn-danger'
document.addEventListener('DOMContentLoaded', function() {
    const deleteLinks = document.querySelectorAll('.btn-danger');
    deleteLinks.forEach(link => {
        link.addEventListener('click', confirmDelete);
    });
});

// Menampilkan notifikasi
function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show`;
    notification.role = 'alert';
    notification.innerHTML = `${message}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>`;
    
    document.body.prepend(notification);

    setTimeout(() => {
        notification.classList.remove('show');
        notification.classList.add('fade');
    }, 3000); // Hapus notifikasi setelah 3 detik
}

// Contoh pemanggilan showNotification
document.addEventListener('DOMContentLoaded', function() {
    // Anda dapat mengganti kode ini dengan logika yang sesuai dengan aplikasi Anda
    if (document.location.search.includes('success=true')) {
        showNotification('Operasi berhasil!', 'success');
    }
});

// Validasi form kursus
document.addEventListener('DOMContentLoaded', function() {
    const kursusForm = document.querySelector('form');
    if (kursusForm) {
        kursusForm.addEventListener('submit', function(event) {
            const judul = document.getElementById('judul').value.trim();
            const deskripsi = document.getElementById('deskripsi').value.trim();
            const durasi = document.getElementById('durasi').value.trim();

            if (judul === '' || deskripsi === '' || durasi === '') {
                alert('Semua field harus diisi!');
                event.preventDefault(); // Batalkan pengiriman form jika ada field kosong
            }
        });
    }
});
