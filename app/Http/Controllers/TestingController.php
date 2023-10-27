<?php

namespace App\Http\Controllers;

use App\Models\testing;
use App\Http\Requests\StoretestingRequest;
use App\Http\Requests\UpdatetestingRequest;

class TestingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testing = new testing();
        $collection = $testing->getDataCollection();

        $chunks = $collection->chunk(8);

        $result = $chunks->all();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diperoleh',
            'data' => $result
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
    public function store(StoretestingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(testing $testing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(testing $testing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetestingRequest $request, testing $testing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(testing $testing)
    {
        //
    }
}
