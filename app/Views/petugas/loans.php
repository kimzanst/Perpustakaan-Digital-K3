<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- 🔹 NAVBAR DENGAN LOGO DAN LOGOUT -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Perpustakaan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <a href="<?= base_url('logout') ?>" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="mb-4">Daftar Peminjaman</h2>

        <!-- 🔹 Tabel Daftar Peminjaman -->
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Nama Peminjam</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($loans as $loan): ?>
                <tr>
                    <td><?= esc($loan['visitor_name']); ?></td>
                    <td><?= esc($loan['book_title']); ?></td>
                    <td><?= esc($loan['borrow_date']); ?></td>
                    <td><?= esc($loan['status']); ?></td>
                    <td>
                        <?php if ($loan['status'] === 'borrowed'): ?>
                            <form action="<?= base_url('petugas/loans/update-status/' . $loan['id']); ?>" method="post">
                                <button type="submit" class="btn btn-success">Dikembalikan</button>
                            </form>
                        <?php else: ?>
                            <span class="text-muted">Selesai</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
