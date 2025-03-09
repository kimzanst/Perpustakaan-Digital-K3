<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Daftar Peminjaman Saya</h2>
            <!-- ✅ Tombol "Kembali" -->
            <button class="btn btn-secondary" onclick="goBack()">⬅ Kembali</button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nama Peminjam</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
    <?php if (empty($loans)): ?>
        <tr>
            <td colspan="4" class="text-center">Tidak ada peminjaman ditemukan</td>
        </tr>
    <?php else: ?>
        <?php foreach ($loans as $loan): ?>
        <tr>
            <td><?= esc($loan['visitor_name']); ?></td>
            <td><?= esc($loan['book_title']); ?></td>
            <td><?= esc($loan['borrow_date']); ?></td>
            <td>
                <span class="badge bg-<?= $loan['status'] == 'borrowed' ? 'warning' : 'success' ?>">
                    <?= esc($loan['status']); ?>
                </span>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- ✅ Script untuk tombol "Kembali" -->
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
