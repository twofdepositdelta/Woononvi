<?php

namespace App\Http\Controllers\API;

use App\Models\Vehicle;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function getDocumentTypes()
    {
        $data = TypeDocument::orderBy('label')->get();
        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'type_document_id' => 'required|max:255|string',
            'expiry_date' => 'required|date',
            'vehicle_id' => 'required|max:255|string',
            'paper' => 'required|mimes:jpeg,png,jpg,gif,pdf|max:1024',
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Quelque chose s\'est mal déroulée. Veuillez réessayer svp !',
                'errors' => $validator->errors()
            ], 422);
        }

        $number = Str::random(8);

        $paperPath = null;
        if ($request->hasFile('paper')) {
            $paperPath = $request->file('paper')->store("api/drivers/$user->id/documents", 'public'); 
        }

        $document = Document::create([
            'slug' => Str::slug($number),
            'number' => $number,
            'paper' => $paperPath,
            'vehicle_id' => $request->vehicle_id,
            'type_document_id' => $request->type_document_id,
            'expiry_date' => $request->expiry_date,
        ]);

        $vehicle = Vehicle::whereId($request->vehicle_id)->with(['typeVehicle', 'documents.typeDocument'])->first();

        return response()->json([
            'success' => true,
            'vehicle' => $vehicle,
            'message' => 'Document ajouté avec succès !',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        //
    }
}