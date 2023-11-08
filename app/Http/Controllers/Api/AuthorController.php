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
        //
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

        $record = Author::find($id);

        if (!$record) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found'
            ],404);
        }


        $record->name_author = $request->input('name_author');
        $record->address = $request->input('address');

        $record->save();

        return response()->json([
            'status' => true,
            'message' => 'data update successfully',
            'date' => $record
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $record = Author::find($id);
        
        if (!$record) {
            return response()->json([
                'status' => false,
                'message' => 'data not found'
            ],404);
        }

        $record->delete();
        return response()->json([
            'status' => true,
            'message' => 'data is delete'
        ], 200);
    }
}
