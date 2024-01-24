<?php

namespace App\Models;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $table = "buku";
    protected $fillable = [
        'category_id',
        'penerbit_buku_id',
        'judul_buku',
        'pengarang',
        'tahun_terbit',
        'isbn',
        'buku_baik',
        'buku_rusak',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'penerbit_buku_id'); // Corrected the foreign key name
    }
}
