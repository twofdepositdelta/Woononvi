<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Document;
use App\Models\TypeDocument;
use Illuminate\Http\Request;
use App\Mail\DocumentRejetStatus;
use Illuminate\Support\Facades\Mail;
use App\Mail\DocumentValidationStatus;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

      public function __construct() {

        if (!auth()->user()->hasAnyRole(['super admin', 'manager' ,'dev'])) {
            // Si l'utilisateur n'a pas le rôle requis, lancer une exception ou une erreur
            abort(401);
        }

        $this->var = 'valeur'; // Exemple de variable à initialiser

     }
    public function index()
    {
        //

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
    public function show(User $user)
{
    // La variable $user contient déjà l'utilisateur recherché via l'email

}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $Document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $Document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $Document)
    {
        //
    }

    public function validated( Document $document)
    {
      if (auth()->user()->hasAnyRole(['super admin', 'manager'])){

        // Si le document est validé, retirer le rejet

        $document->is_validated = !$document->is_validated;
        if ($document->is_validated) {
            $document->is_rejected = false;
        }
        $document->save();

        $user = $document->user;


        $messageContent = '';

        if ($document->is_validated) {
            $document->is_validated = true;
            if ($document->user->hasRole('driver')) {
                // Si le document est un "Permis de conduire numérique" ou un "Cip", on met à jour le statut de l'utilisateur
                if ($document->typeDocument->label == "Permis de conduire" || $document->typeDocument->label == "Cip") {
                    // Vérifier si les deux documents "Permis de conduire" et "Cip" sont validés
                    $permits = $document->user->documents()->whereIn('type_document_id', [
                        TypeDocument::where('label', 'Permis de conduire')->first()->id,
                        TypeDocument::where('label', 'Cip')->first()->id
                    ])->where('is_validated', true)->count();

                    // Si les deux documents sont validés, on active le compte
                    if ($permits == 2) {
                        $user->status = true; // Le compte devient activé
                        $user->save();
                    }
                        }
            } else {
                // Si l'utilisateur n'a pas le rôle 'driver' et que le document est un "Cip", on active l'utilisateur
                if ($document->typeDocument->label == "Cip") {
                    $user->status = true; // Le compte devient activé
                    $user->save();
                }
            }

            $document->save();
        } else {
            // Si le document n'est pas validé
            $document->is_validated = false;

            if ($document->user->hasRole('driver')) {
                // Si le document est un "Permis de conduire" ou "Cip", on désactive le compte de l'utilisateur
                if ($document->typeDocument->label == "Permis de conduire" || $document->typeDocument->label == "Cip") {
                    $user->status = false; // Le compte devient désactivé
                    $user->save();
                }
            } else {
                // Si l'utilisateur n'a pas le rôle 'driver' et que le document est un "Cip", on désactive le compte de l'utilisateur
                if ($document->typeDocument->label == "Cip") {
                    $user->status = false; // Le compte devient désactivé
                    $user->save();
                }
            }

            $document->save();
        }

        // Vérifier si tous les documents de l'utilisateur sont validés
        $allDocumentsValidated = $user->documents->every(function($doc) {
            return $doc->is_validated;
        });

        // Si tous les documents sont validés, on valide le compte utilisateur
        if ($allDocumentsValidated) {
            // Message de confirmation de validation
            $messageContent = 'Tous vos documents ont été validés. Votre compte est maintenant validé.';
            // Envoyer l'email avec le message approprié
            Mail::to($user->email)->send(new DocumentValidationStatus($messageContent));
        }

      return redirect()->back()->with('success', 'Le statut de validation du  a été mis à jour.');

      }
      else
      {
        abort(401);
      }


    }


    public function reason(Request $request)
    {
      if (auth()->user()->hasAnyRole(['super admin', 'manager']))
      {

         // Récupérer l'ID du document depuis le champ caché
            $docId = $request->document_id;

            // Trouver le document dans la base de données
            $document = Document::find($docId);


            $document->update([
                'is_rejected'=>true,
                'reason'=>$request->reason
            ]);

            $user=$document->user;
            if ($document->typeDocument->label == "Permis de conduire" || $document->typeDocument->label == "Cip") {
                $user->status=false;
                    $user->save();
                }

            Mail::to($document->user->email)->send(new DocumentRejetStatus($document));
            // Rediriger avec un message de succès

            return redirect()->back()->with('success', 'Le statut de validation du document a été rejeté.');

        }else{
            abort(401);
        }
    }

}



