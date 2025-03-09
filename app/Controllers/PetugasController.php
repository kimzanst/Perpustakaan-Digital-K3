<?php

namespace App\Controllers;

use App\Models\LoanModel;
use CodeIgniter\Controller;

class PetugasController extends Controller
{
    public function index()
    {
        return redirect()->to('/petugas/loans'); // ✅ Redirect langsung ke halaman loans
    }

    public function loans()
    {
        if (session()->get('role') !== 'petugas') {
            return redirect()->to('/login')->with('error', 'Anda tidak memiliki izin!');
        }

        $loanModel = new LoanModel();
        $data['loans'] = $loanModel
            ->select('loans.*, books.title AS book_title, books.author')
            ->join('books', 'books.id = loans.book_id')
            ->orderBy('loans.borrow_date', 'DESC')
            ->findAll();

        return view('petugas/loans', $data);
    }
    
}
