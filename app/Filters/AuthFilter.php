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

        // 🔹 Cek apakah pengguna sudah login
        if (!session()->get('logged_in') && current_url() !== base_url('/')) {
            return redirect()->to('/login'); // ✅ Izinkan halaman utama tetap bisa diakses
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
}
