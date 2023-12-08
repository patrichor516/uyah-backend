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

    public function book()
    {
        $data = Books::all();
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
    $validatedData = $request->validate([
        'name_book' => 'required',
        'category_id' => 'required',
        'author_id' => 'required|array', // Perbarui validasi ini
    ]);

    // Buat instance baru dari model Books.
    $newRecord = new Books();
    $newRecord->name_book = $request->input('name_book');
    $newRecord->category_id = $request->input('category_id');
    $newRecord->save();        

    $authorIds = $request->input('author_id');
    foreach ($authorIds as $key => $authorId) {
        $author = Author::find($authorId);

        if (!$author) {
            // Jika penulis tidak ditemukan, buat instance baru
            $author = new Author();
            // Tentukan kolom yang harus diisi
            $author->name_author = "Nama Penulis Baru"; // Sesuaikan dengan kolom di tabel Author
            $author->save();
        }

        // Tambahkan penulis ke buku
        $newRecord->author()->attach($author->id);
    }

    return response()->json([
        'status' => true,
        'message' => 'Data berhasil ditambahkan',
        'data' => $newRecord->load('author')
    ], 200);
}
}
