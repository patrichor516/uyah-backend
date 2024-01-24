<?php

namespace App\Models;
use App\Models\Books;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $table = "penerbit" ;
    protected $fillable = [
        'kode_penerbit',
        'nama_penerbit',
        'verf_penerbit'
    ];


}
