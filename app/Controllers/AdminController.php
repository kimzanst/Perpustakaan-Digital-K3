<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Models\BookModel;
use CodeIgniter\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin/books');
    }

    public function users()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();

        return view('admin/users', $data);
    }
    public function resetPassword($role)
    {
        $model = new UserModel();

        // Pastikan role valid
        if (!in_array($role, ['admin', 'petugas'])) {
            return redirect()->to('/login')->with('error', 'Role tidak valid!');
        }
    
        // Set password baru
        $newPassword = ($role === 'admin') ? 'admin123' : 'petugas123';
    
        $model->where('role', $role)->set([
            'password' => password_hash($newPassword, PASSWORD_DEFAULT)
        ])->update();
    
        return redirect()->to('/login')->with('success', 'Password berhasil direset!');
    }
    
}

