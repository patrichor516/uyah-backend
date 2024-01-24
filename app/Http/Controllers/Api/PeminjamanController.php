<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Books;
use App\Models\Category;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Peminjaman::all(); // Use 'books' instead of 'Books'
        $data = Peminjaman::with('books')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diperoleh',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $buku = Books::firstOrCreate(['judul_buku' => $request->input('judul_buku')]);

        $newRecord = new Peminjaman();
        $newRecord->nama_anggota = $request->input('nama_anggota');
        $newRecord->tanggal_peminjaman = $request->input('tanggal_peminjaman');
        $newRecord->tanggal_pengembalian = $request->input('tanggal_pengembalian');
        $newRecord->kondisi_buku_saat_dipinjam = $request->input('kondisi_buku_saat_dipinjam');
        $newRecord->kondisi_buku_saat_dikembalikan = $request->input('kondisi_buku_saat_dikembalikan');
        $newRecord->denda = $request->input('denda');

        // Set the foreign key value directly
        $newRecord->judul_buku_id = $buku->id;

        $newRecord->save();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditambahkan',
            'data' => $newRecord
        ], 200);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $book = Books::with('category', 'author')->findOrFail($id);

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diperoleh',
                'data' => $book
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name_book' => 'required',
            'category_id' => 'required',
            'author_id' => 'array',
        ]);

        $record = Books::find($id);

        if (!$record) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found'
            ], 404);
        }

        $record->name_book = $request->input('name_book');
        $record->category_id = $request->input('category_id');
        $record->save();

        // Detach penulis hanya jika ada data author_id yang dikirimkan
        if ($request->has('author_id')) {
            $record->author()->detach();

            $authorIds = $request->input('author_id');
            foreach ($authorIds as $key => $authorId) {
                $author = Author::find($authorId);

                if (!$author) {
                    $author = new Author();
                    $author->name_author = "Nama Penulis Baru";
                    $author->save();
                }
                $record->author()->attach($author->id);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Data successfully updated',
            'data' => $record->load('author')
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $record = Books::find($id);

        if (!$record) {
            return response()->json([
                'status' => false,
                'message' => 'data not found'
            ], 404);
        }

        // Delete related records in the pivot table (book_author)
        $record->author()->detach();

        // Now, delete the book record
        $record->delete();

        return response()->json([
            'status' => true,
            'message' => 'data delete'
        ], 200);
    }

    public function create(Request $request)
    {

        // Buat instance baru dari model Books.
        $newRecord = new Peminjaman();
        $newRecord->judul_buku_id = $request->input('judul_buku_id');
        $newRecord->nama_anggota = $request->input('nama_anggota');
        $newRecord->tanggal_peminjaman = $request->input('tanggal_peminjaman');
        $newRecord->tanggal_pengembalian = $request->input('tanggal_pengembalian');
        $newRecord->kondisi_buku_saat_dipinjam = $request->input('kondisi_buku_saat_dipinjam');
        $newRecord->kondisi_buku_saat_dikembalikan = $request->input('kondisi_buku_saat_dikembalikan');
        $newRecord->denda = $request->input('denda');
        $newRecord->save();


        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditambahkan',
            'data' => $newRecord
        ], 200);
    }
}
