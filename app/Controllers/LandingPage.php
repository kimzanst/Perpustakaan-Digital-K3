<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class LandingPage extends Controller
{
    public function index()
    {
        return view('landing_page'); // ✅ Pastikan ini bisa diakses tanpa login
    }
    
}
if (!session()->get('logged_in')) {
    return redirect()->to('/login');
}