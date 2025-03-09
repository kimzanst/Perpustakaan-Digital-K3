<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $currentUrl = current_url();
        $baseUrl = base_url();

        // 🔹 Halaman yang tidak memerlukan login (izin akses publik)
        $publicPages = [
            $baseUrl . '/',
            $baseUrl . '/login',
            $baseUrl . '/register',
        ];

        // ✅ Izinkan akses ke halaman utama, login, dan register tanpa login
        if (in_array($currentUrl, $publicPages)) {
            // Jika pengguna sudah login, cegah kembali ke halaman login atau register
            if ($session->get('logged_in') && ($currentUrl === $baseUrl . '/login' || $currentUrl === $baseUrl . '/register')) {
                return $this->redirectToDashboard($session->get('role'));
            }
            return;
        }

        // ❌ Blokir akses jika belum login
        if (!$session->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // 🔹 Jika tidak ada argument role, cukup cek login saja
        if (empty($arguments) || !is_array($arguments)) {
            return;
        }

        // 🔹 Periksa apakah role pengguna sesuai dengan yang diperlukan
        $userRole = $session->get('role');
        if (!in_array($userRole, $arguments)) {
            return redirect()->to('/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada perubahan setelah response dikirim
    }

    private function redirectToDashboard($role)
    {
        switch ($role) {
            case 'admin':
                return redirect()->to('/admin/books');
            case 'petugas':
                return redirect()->to('/petugas/loans');
            case 'peminjam':
                return redirect()->to('/dashboard/visitor');
            default:
                session()->destroy();
                return redirect()->to('/login')->with('error', 'Role tidak valid!');
        }
    }
}
