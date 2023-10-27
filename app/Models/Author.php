<?php

namespace App\Models;
use App\Models\Books;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $table = "author" ;
    protected $fillable = [
        'name_author',
        'address',
    ];

    public function books()
{
    return $this->belongsToMany(Books::class, 'book_author', 'author_id', 'book_id');
}
}
