<?php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\LoanModel;
use CodeIgniter\Controller;

class LoanController extends Controller
{
    public function __construct()
    {
        helper(['url', 'form']); // ✅ Helper untuk validasi dan redirect
    }

    // 🔹 PEMINJAM - Bisa melihat daftar peminjaman
    public function index()
    {
        $loanModel = new LoanModel();
        $data['loans'] = $loanModel
            ->select('loans.*, books.title AS book_title')
            ->join('books', 'books.id = loans.book_id')
            ->orderBy('loans.borrow_date', 'DESC')
            ->findAll();

        return view('loans/index', $data);
    }

    // 🔹 PEMINJAM - Bisa meminjam buku
    public function borrow()
    {
        $bookModel = new BookModel();
        $data['books'] = $bookModel->where('stock >', 0)->findAll();

        return view('loans/borrow', $data); // ✅ Peminjam bisa memilih buku untuk dipinjam
    }

    // 🔹 PEMINJAM - Menyimpan data peminjaman buku
    public function store()
    {
        $loanModel = new LoanModel();
        $bookModel = new BookModel();
        $db = \Config\Database::connect();
        $db->transStart(); // ✅ Mulai transaksi

        $bookId = $this->request->getPost('book_id');
        $visitorName = $this->request->getPost('visitor_name');

        // 🔹 Cek ketersediaan buku
        $book = $bookModel->find($bookId);
        if (!$book || $book['stock'] <= 0) {
            return redirect()->back()->with('error', 'Buku tidak tersedia!');
        }

        // 🔹 Simpan data peminjaman
        $loanModel->insert([
            'visitor_name' => $visitorName,
            'book_id'      => $bookId,
            'borrow_date'  => date('Y-m-d'),
            'return_date'  => null,
            'status'       => 'borrowed'
        ]);

        // 🔹 Kurangi stok buku
        $bookModel->update($bookId, ['stock' => $book['stock'] - 1]);

        $db->transComplete(); // ✅ Selesaikan transaksi

        return redirect()->to('/peminjam/loans')->with('success', 'Buku berhasil dipinjam!');
    }

    // 🔹 PETUGAS - Hanya Petugas yang bisa memperbarui status
    public function updateStatus($id)
    {
        // 🚫 Cegah akses jika bukan petugas
        if (session()->get('role') !== 'petugas') {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin!');
        }

        $loanModel = new LoanModel();
        $bookModel = new BookModel();
        $db = \Config\Database::connect();
        $db->transStart(); // ✅ Mulai transaksi

        // 🔹 Ambil data peminjaman
        $loan = $loanModel->find($id);
        if (!$loan) {
            return redirect()->back()->with('error', 'Peminjaman tidak ditemukan!');
        }

        // 🔹 Update status menjadi "returned"
        $loanModel->update($id, [
            'status'      => 'returned',
            'return_date' => date('Y-m-d')
        ]);

        // 🔹 Kembalikan stok buku
        $book = $bookModel->find($loan['book_id']);
        if ($book) {
            $bookModel->update($loan['book_id'], ['stock' => $book['stock'] + 1]);
        }

        $db->transComplete(); // ✅ Selesaikan transaksi
        return redirect()->to('/petugas')->with('success', 'Status peminjaman diperbarui!');
    }
}
