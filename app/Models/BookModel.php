<?php
namespace App\Models;
use CodeIgniter\Model;

class BookModel extends Model {
    protected $table = 'books'; 
    protected $allowedFields = ['title', 'author', 'category', 'stock'];
}
