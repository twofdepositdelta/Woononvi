<?php

namespace App\Http\Controllers\API;

use App\Models\Vehicle;
use App\Models\Document;
use App\Models\TypeDocument;
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
            'number' => 'required|max:255|string',
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

        $type_document = TypeDocument::whereLabel($request->type_document_id)->first();
        if (!$type_document) {
            return response()->json([
                'success' => false,
                'message' => 'Type de document invalide !',
            ], 422);
        }

        // Vérifiez si un document de ce type existe déjà pour le véhicule
        $existingDocument = Document::where('vehicle_id', $request->vehicle_id)
            ->where('type_document_id', $type_document->id)
            ->first();

        if ($existingDocument) {
            return response()->json([
                'success' => false,
                'message' => 'Un document de ce type est déjà ajouté pour ce véhicule.',
            ], 422);
        }

        $user = $request->user();
        $number = Str::random(8);

        $paperPath = null;
        if ($request->hasFile('paper')) {
            $paperPath = $request->file('paper')->store("api/drivers/$user->id/documents", 'public'); 
        }

        $document = Document::create([
            'slug' => Str::slug($number),
            'number' => $request->number,
            'paper' => $paperPath,
            'vehicle_id' => $request->vehicle_id,
            'type_document_id' => $type_document->id,
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
    public function destroy(Request $request)
    {
        $rules = [
            'document_id' => 'required|max:255|string',
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Quelque chose s\'est mal déroulée. Veuillez réessayer svp !',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();

        $document = Document::where('id', $request->document_id)->first();

        if (!$document) {
            return response()->json([
                'success' => false,
                'message' => 'Document introuvable !',
            ], 404);
        }

        // Supprimer le fichier du stockage si le chemin existe
        if ($document->paper && Storage::disk('public')->exists($document->paper)) {
            Storage::disk('public')->delete($document->paper);
        }

        // Supprimer le document de la base de données
        $document->delete();

        $vehicle = Vehicle::whereId($document->vehicle_id)->with(['typeVehicle', 'documents.typeDocument'])->first();

        return response()->json([
            'success' => true,
            'vehicle' => $vehicle,
            'message' => 'Document supprimé avec succès.',
        ], 200);
    }
}