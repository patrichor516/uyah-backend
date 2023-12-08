<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Author::all();
        return response()->json([
            'status' => true,
            'message' => 'data successfully',
            'data' => $data
        ], 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $newRecord = new Author();
        $newRecord->name_author = $request->input('name_author');
        $newRecord->address = $request->input('address');
        

        $newRecord->save();

        return response()->json([
            'status' => true,
            'message' => 'data successfully',
            'data' => $newRecord
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $author = Author::findOrFail($id);
    
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diperoleh',
                'data' => $author
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
        $validateData = $request->validate([
            'name_author' => 'required',
            'address' => 'required',
        ]);

        $record = Author::findOrFail($id);

        $record->name_author = $request->input('name_author');
        $record->address = $request->input('address');

        $record->save();

        return response()->json([
            'status' => true,
            'message' => 'Data updated successfully',
            'data' => $record
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data deleted successfully',
            'data' => $author
        ], 200);
}
}