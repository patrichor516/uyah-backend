<?php

namespace App\Models;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = "peminjaman";
    protected $fillable = [
        'judul_buku_id',
        'nama_anggota',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'kondisi_buku_saat_dipinjam',
        'kondisi_buku_saat_dikembalikan',
        'denda'
    ];

   
 // Peminjaman model
 public function books(){
    return $this->belongsTo(Books::class, 'judul_buku_id');
}
}
