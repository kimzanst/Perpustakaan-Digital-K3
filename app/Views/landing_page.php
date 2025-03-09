<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page - Sistem Peminjaman Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
        }
        .hero-section {
            height: 90vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('https://source.unsplash.com/1600x900/?library,books') no-repeat center center/cover;
            color: white;
            text-align: center;
            position: relative;
        }
        .hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }
        .hero-content {
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body>

    <!-- 🔹 HEADER -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">PROJECT K3 IPI</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/login'); ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/register'); ?>">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- 🔹 HERO SECTION -->
    <section class="hero-section">
        <div class="container hero-content">
            <h1 class="display-4 fw-bold">Selamat Datang di Pustaka Digital</h1>
            <p class="lead">Project Sementara Kelompok 3</p>
            <a href="<?= base_url('/login'); ?>" class="btn btn-primary btn-lg">Mulai Sekarang</a>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
