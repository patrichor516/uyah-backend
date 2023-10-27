<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Books;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Books::all();
        $data = Books::with('category','author')->get();
        
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
        $validatedData = $request->validate([
            'name_book' => 'required',
            'name_category' => 'required',
            'name_author' => 'required', // Pastikan ini array
            'address' => 'required', // Validasi untuk alamat
        ]);

        // Cari kategori berdasarkan "name_category" dari request.
        $category = Category::firstOrCreate(['name_category' => $request->input('name_category')]);

        // Buat instance baru dari model Books.
        $newRecord = new Books();
        $newRecord->name_book = $request->input('name_book');

        // Sambungkan buku dengan kategori yang sesuai.
        $newRecord->category()->associate($category);

        $newRecord->save();

        // Ambil penulis dari request dan sambungkan dengan buku.
      $authorNames = (is_array($request->input('name_author'))) ? $request->input('name_author') : [$request->input('name_author')];
    $authorAddresses = (is_array($request->input('address'))) ? $request->input('address') : [$request->input('address')];// Ambil alamat dari request
       
        foreach ($authorNames as $key => $authorName) {
            $author = Author::firstOrCreate(['name_author' => $authorName, 'address' => $authorAddresses[$key]]); // Simpan alamat penulis
            $newRecord->author()->attach($author);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditambahkan',
            'data' => $newRecord->load('author') // Memuat relasi penulis (authors) dalam data yang ditampilkan
        ], 200);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name_book' => 'required',
            'name_category' => 'required', // Ubah ke 'name_category' jika perlu
            'name_author' => 'array', // Validasi array
            'address' => 'array', // Validasi array
        ]);
    
        $record = Books::find($id);
    
        if (!$record) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found'
            ], 404);
        }
    
        // Cari kategori berdasarkan "name_category" dari request.
        $category = Category::firstOrCreate(['name_category' => $request->input('name_category')]);
    
        // Periksa validasi data sebelum mengubah data.
        $record->name_book = $request->input('name_book');
    
        // Sambungkan buku dengan kategori yang sesuai dan gantikan kategori sebelumnya.
        $record->category()->associate($category);
    
        $record->save();
    
        $authorNames = $request->input('name_author', []);
        $authorAddresses = $request->input('address', []);
    
        // Hapus penulis yang sudah terhubung dan tambahkan yang baru
        $record->author()->detach();
        foreach ($authorNames as $key => $authorName) {
            $author = Author::firstOrCreate(['name_author' => $authorName, 'address' => $authorAddresses[$key]]);
            $record->author()->attach($author);
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

        $record->delete();
        return response()->json([
            'status' => true,
            'message' => 'data  delete'
        ], 200);
    }
}
