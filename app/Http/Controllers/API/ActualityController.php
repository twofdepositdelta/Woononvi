<?php

namespace App\Http\Controllers\API;

use App\Models\Actuality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActualityController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Actuality::wherePublished(true)
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();

        return response()->json([
            'success' => true,
            'data' => $data,
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Actuality $actuality)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Actuality $actuality)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Actuality $actuality)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Actuality $actuality)
    {
        //
    }
}