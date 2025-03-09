<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjam Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Pinjam Buku</h2>

        <!-- Notifikasi Error -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <!-- Form Peminjaman -->
        <form action="<?= base_url('peminjam/loans/store') ?>" method="post">
            <?= csrf_field() ?> <!-- Tambahkan CSRF untuk keamanan -->

            <div class="mb-3">
                <label for="visitor_name" class="form-label">Email</label>
                <input type="text" class="form-control" id="visitor_name" name="visitor_name" required>
            </div>

            <div class="mb-3">
                <label for="book_id" class="form-label">Pilih Buku</label>
                <select class="form-control" id="book_id" name="book_id" required>
                    <option value="">-- Pilih Buku --</option>
                    <?php foreach ($books as $book): ?>
                        <option value="<?= $book['id'] ?>">
                            <?= $book['title'] ?> (Stok: <?= $book['stock'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Pinjam</button>
            <a href="<?= base_url('dashboard/visitor') ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
