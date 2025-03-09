<?php
namespace App\Controllers;

use App\Models\BookModel;
use CodeIgniter\Controller;

class BookController extends Controller
{
    public function index()
    {
        $bookModel = new BookModel();
        $data['books'] = $bookModel->findAll();

        return view('admin/books', $data); // ✅ Ubah folder view ke "admin"
    }

    public function create()
    {
        return view('admin/create-book'); // ✅ Pastikan file ada di "admin/"
    }

    public function store()
{
    $bookModel = new BookModel();

    $bookModel->insert([
        'title' => $this->request->getPost('title'),
        'author' => $this->request->getPost('author'),
        'category' => $this->request->getPost('category'),
        'stock' => $this->request->getPost('stock')
    ]);

    return redirect()->to('/admin/books')->with('success', 'Buku berhasil ditambahkan!'); // ✅ Redirect ke daftar buku
}
public function edit($id)
{
    $bookModel = new BookModel();
    $data['book'] = $bookModel->find($id);

    if (!$data['book']) {
        return redirect()->to('/admin/books')->with('error', 'Buku tidak ditemukan.');
    }

    return view('admin/edit-book', $data);
}

public function update($id)
{
    $bookModel = new BookModel();

    // Periksa apakah buku ada
    $book = $bookModel->find($id);
    if (!$book) {
        return redirect()->to('/admin/books')->with('error', 'Buku tidak ditemukan.');
    }

    // Update buku
    $bookModel->update($id, [
        'title' => $this->request->getPost('title'),
        'author' => $this->request->getPost('author'),
        'category' => $this->request->getPost('category'),
        'stock' => $this->request->getPost('stock')
    ]);

    return redirect()->to('/admin/books')->with('success', 'Buku berhasil diperbarui!');
}
    public function delete($id)
    {
        $bookModel = new BookModel();
        $bookModel->delete($id);

        return redirect()->to('/admin/books')->with('success', 'Buku berhasil dihapus!');
    }
}
