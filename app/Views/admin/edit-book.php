<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Edit Buku</h2>

        <form action="<?= base_url('/admin/update-book/' . $book['id']) ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label>Judul</label>
                <input type="text" name="title" class="form-control" value="<?= esc($book['title']); ?>" required>
            </div>
            <div class="mb-3">
                <label>Penulis</label>
                <input type="text" name="author" class="form-control" value="<?= esc($book['author']); ?>" required>
            </div>
            <div class="mb-3">
                <label>Kategori</label>
                <input type="text" name="category" class="form-control" value="<?= esc($book['category']); ?>" required>
            </div>
            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stock" class="form-control" value="<?= esc($book['stock']); ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="<?= base_url('/admin/books') ?>" class="btn btn-secondary">Batal</a>
        </form>

    </div>
</body>
</html>
