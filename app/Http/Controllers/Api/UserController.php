<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();
    
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
        $newData = new User();
        $newData->kode_user = $request->input('kode_user');
        $newData->nis = $request->input('nis');
        $newData->fullname = $request->input('fullname');
        $newData->username = $request->input('username');
        $newData->kelas = $request->input('kelas');
        $newData->alamat = $request->input('alamat');
        $newData->verif = $request->input('verif');
        $newData->join_date = $request->input('join_date');
        $newData->terakhir_login = $request->input('terakhir_login');
        $newData->save();

        return response()->json([
            'status' => true,
            'message' => 'yeyy',
            'data' => $newData
        ]);
    }

    public function update(Request $request, string $id)
    {

        $newData = User::findOrFail($id);

        $newData->kode_user = $request->input('kode_user');
        $newData->nis = $request->input('nis');
        $newData->fullname = $request->input('fullname');
        $newData->username = $request->input('username');
        $newData->kelas = $request->input('kelas');
        $newData->alamat = $request->input('alamat');
        $newData->verif = $request->input('verif');
        $newData->join_date = $request->input('join_date');
        $newData->terakhir_login = $request->input('terakhir_login');
        $newData->save();

        $newData->save();

        return response()->json([
            'status' => true,
            'message' => 'Data updated successfully',
            'data' => $newData
        ], 200);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data deleted successfully',
            'data' => $user
        ], 200);
    }
}
