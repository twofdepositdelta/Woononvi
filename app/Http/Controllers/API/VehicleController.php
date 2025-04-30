<?php

namespace App\Http\Controllers\API;

use App\Models\Vehicle;
use App\Models\TypeVehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function getVehicleTypes()
    {
        $data = TypeVehicle::orderBy('label')->get();
        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

    public function getUserVehicles(Request $request)
    {
        $user = $request->user();
        $data = Vehicle::whereDriverId($user->id)->with(['typeVehicle', 'documents.typeDocument'])->get();

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
            'licence_plate' => 'required|max:255|string|unique:vehicles',
            'mark' => 'required|max:255|string',
            'seats' => 'required|max:255|string',
            'color' => 'required|max:255|string',
            'model' => 'required|max:255|string',
            'year' => 'required|max:255',
            'logbook' => 'required|mimes:pdf|max:6000',
            'image' => 'required|mimes:jpeg,png,jpg,gif,pdf|max:6000',
            'vehicle_type' => 'required|max:255|string',
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                // 'message' => 'Quelque chose s\'est mal déroulée. Veuillez réessayer svp !',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $user = $request->user();

        $vehiculeType = TypeVehicle::whereLabel($request->vehicle_type)->first();

        if($vehiculeType) {
            // Vérifiez si l'utilisateur a déjà un véhicule
            $existingVehicle = Vehicle::whereDriverId($user->id)->first();

            $is_active = true;

            if($existingVehicle) {
                $is_active = false;
                $message = "Véhicule ajouté avec succès ! Activez cela pour le prendre en compte dans les prochains trajets.";
            } else {
                $message = "Véhicule ajouté avec succès !";
            }

            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store("api/drivers/$user->id/images", 'public'); 
            }

            $logbookPath = null;
            if ($request->hasFile('logbook')) {
                $logbookPath = $request->file('logbook')->store("api/drivers/$user->id/logbooks", 'public'); 
            }

            $vehicle = Vehicle::create([
                'licence_plate' => $request->licence_plate,
                'seats' => $request->seats,
                'vehicle_mark' => $request->mark,
                'vehicle_model' => $request->model,
                'is_active' => $is_active,
                'vehicle_year' => $request->year,
                'color' => $request->color,
                'main_image' => $imagePath,
                'logbook' => $logbookPath,
                'slug' => Str::slug($request->licence_plate),
                'type_vehicle_id' => $vehiculeType->id,
                'driver_id' => $user->id,
            ]);

            return response()->json([
                'success' => true,
                'vehicle' => $vehicle,
                'message' => $message,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'errors' => ['Veuillez revoir les informations du type de véhicule !'],
            ], 422);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $rules = [
            'licence_plate' => 'required|max:255|string|unique:vehicles,licence_plate,' . $request->vehicle_id,
            'mark' => 'required|max:255|string',
            'seats' => 'required|max:255|string',
            'color' => 'required|max:255|string',
            'model' => 'required|max:255|string',
            'year' => 'required|max:255',
            'logbook' => 'nullable|mimes:pdf|max:6000',
            'main_image' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:6000',
            'vehicle_type' => 'required|max:255|string',
            'vehicle_id' => 'required|max:255|string',
            // 'is_active' => 'string|in:0,1'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'reason' => false,
                // 'message' => 'Quelque chose s\'est mal déroulée. Veuillez réessayer svp !',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $user = $request->user();

        // Vérifier si le solde de l'utilisateur est suffisant
        // if ($user->balance < 1000) {
        //     return response()->json([
        //         'success' => false,
        //         'reason' => true,
        //         'message' => 'Votre solde est insuffisant pour ajouter un véhicule. Veuillez recharger votre compte d\'au moins 1000 FCFA.',
        //     ], 422);
        // }

        $vehicle = Vehicle::where('id', $request->vehicle_id)->where('driver_id', $user->id)->first();

        if (!$vehicle) {
            return response()->json([
                'success' => false,
                'errors' => ['Véhicule non trouvé.'],
            ], 404);
        }

        // Gérer le champ is_active
        if ($request->is_active == '1') {
            // Désactiver tous les autres véhicules du conducteur
            Vehicle::where('driver_id', $user->id)
                ->where('id', '!=', $vehicle->id)
                ->update(['is_active' => false]);

            $vehicle->is_active = true;
        } elseif ($request->is_active == '0') {
            // Vérifier s'il existe d'autres véhicules actifs
            $activeVehicleCount = Vehicle::where('driver_id', $user->id)
                ->where('id', '!=', $vehicle->id)
                ->where('is_active', true)
                ->count();

            if ($activeVehicleCount == 0) {
                return response()->json([
                    'success' => false,
                    'errors' => ['Impossible de désactiver ce véhicule car aucun autre véhicule actif n\'est disponible.'],
                ], 422);
            }

            $vehicle->is_active = false;
        }

        $vehiculeType = TypeVehicle::whereLabel($request->vehicle_type)->first();

        if ($vehiculeType) {
            // Si une nouvelle image est fournie, remplacez l'ancienne et supprimez-la
            if ($request->hasFile('main_image')) {
                $imagePath = $request->file('main_image')->store("api/drivers/$user->id/images", 'public');
                $vehicle->main_image = $imagePath;
            }

            // Si un nouveau logbook est fourni, remplacez l'ancien et supprimez-le
            if ($request->hasFile('logbook')) {
                if ($vehicle->logbook && file_exists($vehicle->logbook)) {
                    unlink('storage/' . $vehicle->logbook);
                }
                $logbookPath = $request->file('logbook')->store("api/drivers/$user->id/logbooks", 'public');
                $vehicle->logbook = $logbookPath;
            }

            // Mettre à jour les autres informations
            $vehicle->update([
                'licence_plate' => $request->licence_plate,
                'seats' => $request->seats,
                'vehicle_mark' => $request->mark,
                'vehicle_model' => $request->model,
                'vehicle_year' => $request->year,
                'color' => $request->color,
                'slug' => Str::slug($request->licence_plate),
                'type_vehicle_id' => $vehiculeType->id,
                'is_active' => $vehicle->is_active,
            ]);

            return response()->json([
                'success' => true,
                'vehicle' => $vehicle,
                'message' => 'Véhicule mis à jour avec succès !',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'errors' => ['Veuillez revoir les informations du type de véhicule !'],
            ], 422);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $rules = [
            'vehicle_id' => 'required|max:255|string',
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                // 'message' => 'Quelque chose s\'est mal déroulée. Veuillez réessayer svp !',
                'errors' => $validator->errors()->all()
            ], 422);
        }

        $vehicle = Vehicle::where('id', $request->vehicle_id)->first();

        if (!$vehicle) {
            return response()->json([
                'success' => false,
                'errors' => ['Véhicule introuvable !'],
            ], 404);
        }

        // if($vehicle->is_validated == true) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Vous ne pouvez plus supprimer ce document !',
        //     ], 422);
        // }

        $user = $request->user();

        // Supprimer le fichier du stockage si le chemin existe
        if ($vehicle->logbook && Storage::disk('public')->exists($vehicle->logbook)) {
            Storage::disk('public')->delete($vehicle->logbook);
        }

        if ($vehicle->main_image && Storage::disk('public')->exists($vehicle->main_image)) {
            Storage::disk('public')->delete($vehicle->main_image);
        }

        // Supprimer le vehicle de la base de données
        $vehicle->delete();

        return response()->json([
            'success' => true,
            'message' => 'Véhicule supprimé avec succès.',
        ], 200);
    }
}