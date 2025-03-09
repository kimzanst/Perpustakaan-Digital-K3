<?php

namespace App\Models;

use CodeIgniter\Model;

class LoanModel extends Model
{
    protected $table = 'loans';
    protected $primaryKey = 'id';
    protected $allowedFields = ['visitor_name', 'book_id', 'borrow_date', 'return_date', 'status'];

    public function getLoans()
    {
        return $this->select('loans.*, books.title AS book_title')
                    ->join('books', 'books.id = loans.book_id')
                    ->orderBy('loans.borrow_date', 'DESC')
                    ->findAll();
    }
}
