<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::all();
    
        return response()->json([
            'status' => true,
            'message' => 'data successfully',
            'data' => $data
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newData = new Category();
        $newData->name_category = $request->input('name_category');

        $newData->save();

        return response()->json([
            'status' => true,
            'message' => 'yeyy',
            'data' => $newData
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $category = Category::findOrFail($id);
    
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diperoleh',
                'data' => $category
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'name_category' => 'required',
        ]);

        $record = Category::findOrFail($id);

        $record->name_category = $request->input('name_category');

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
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data deleted successfully',
            'data' => $category
        ], 200);
    }
}
