<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LandingPage::index'); // ✅ Pastikan ini mengarah ke Landing Page

// 🔹 AUTHENTICATION (Login, Register, Logout)
$routes->get('/login', 'AuthController::login');
$routes->post('/login-process', 'AuthController::loginProcess');
$routes->get('/register', 'AuthController::register');
$routes->post('/register-process', 'AuthController::registerProcess');
$routes->get('/logout', 'AuthController::logout');

// 🔹 DASHBOARD UTAMA (Redirect sesuai role)
$routes->get('/dashboard', 'DashboardController::index');

// ======================= ADMIN ROUTES =======================
$routes->group('admin', ['filter' => 'auth:admin'], function ($routes) {
    $routes->get('/', 'AdminController::index');
    $routes->get('books', 'BookController::index');
    $routes->get('create-book', 'BookController::create');
    $routes->post('store-book', 'BookController::store');
    $routes->get('edit-book/(:num)', 'BookController::edit/$1'); // ✅ Edit Buku
    $routes->post('update-book/(:num)', 'BookController::update/$1'); // ✅ Update Buku
    $routes->delete('delete-book/(:num)', 'BookController::delete/$1'); // ✅ Hapus Buku
});

// ======================= PETUGAS ROUTES =======================
$routes->group('petugas', ['filter' => 'auth:petugas'], function ($routes) {
    $routes->get('/', 'PetugasController::index'); // ✅ Petugas masuk ke dashboard
    $routes->get('loans', 'PetugasController::loans'); // ✅ Petugas bisa melihat daftar pinjaman
    $routes->post('loans/update-status/(:num)', 'LoanController::updateStatus/$1'); // ✅ Hanya Petugas bisa update status peminjaman
});

// ======================= PEMINJAM ROUTES =======================
$routes->group('peminjam', ['filter' => 'auth:peminjam'], function ($routes) {
    $routes->get('dashboard', 'VisitorController::index'); // ✅ Dashboard Peminjam
    $routes->get('loans', 'LoanController::index'); // ✅ Peminjam hanya melihat daftar pinjaman
    $routes->get('loans/borrow', 'LoanController::borrow'); // ✅ Peminjam bisa meminjam buku
    $routes->post('loans/store', 'LoanController::store'); // ✅ Simpan data peminjaman
});

// 🔹 ROUTE PEMINJAM KE `/dashboard/visitor`
$routes->get('/dashboard/visitor', 'VisitorController::index', ['filter' => 'auth:peminjam']);

// 🔹 ALIAS UNTUK `/peminjam/dashboard` ➝ `/dashboard/visitor`
$routes->get('/peminjam/dashboard', function () {
    return redirect()->to('/dashboard/visitor');
});
