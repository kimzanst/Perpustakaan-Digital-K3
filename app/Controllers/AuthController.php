<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function login()
    {
        // Jika sudah login, langsung arahkan ke dashboard masing-masing
        if (session()->get('logged_in')) {
            return $this->redirectToDashboard(session()->get('role'));
        }

        return view('auth/login');
    }

    public function loginProcess()
    {
        $session = session();
        $model = new UserModel();
    
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
    
        $user = $model->where('email', $email)->first();
    
        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'Email tidak ditemukan!');
        }
    
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Password salah!');
        }
    
        // Regenerasi session untuk keamanan
        session()->regenerate();
        $session->set([
            'id'        => $user['id'],
            'email'     => $user['email'],
            'role'      => $user['role'],
            'logged_in' => true
        ]);
    
        return $this->redirectToDashboard($user['role']);
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

    public function register()
    {
        return view('auth/register');
    }

    public function registerProcess()
    {
        $model = new UserModel();
    
        // Validasi input dengan feedback error yang lebih baik
        if (!$this->validate([
            'username'         => 'required|min_length[3]',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'password'         => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Silakan periksa kembali input Anda.');
        }
    
        // Hash password sebelum menyimpan
        $hashedPassword = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
    
        // Simpan user baru sebagai peminjam
        $model->insert([
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => $hashedPassword, 
            'role'     => 'peminjam'
        ]);
    
        return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda telah logout.');
    }
}
