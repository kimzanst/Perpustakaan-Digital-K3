<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BookModel;

class VisitorController extends Controller
{
    public function index()
    {
        $bookModel = new BookModel();
        $data['books'] = $bookModel->findAll(); // 🔹 Ambil semua buku dari database

        return view('dashboard/visitor', $data); // 🔹 Kirim data ke view
    }
}
