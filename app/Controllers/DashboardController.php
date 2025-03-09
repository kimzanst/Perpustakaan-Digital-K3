<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $session = session();
        
        if (!$session->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Anda harus login terlebih dahulu!');
        }

        switch ($session->get('role')) {
            case 'admin':
                return redirect()->to('/admin/dashboard');
            case 'petugas':
                return redirect()->to('/petugas/dashboard');
            case 'peminjam':
                return redirect()->to('/peminjam/dashboard');
            default:
                return redirect()->to('/login')->with('error', 'Role tidak valid!');
        }
    }
}
