<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Mail\DocumentRejetStatus;
use Illuminate\Support\Facades\Mail;
use App\Mail\DocumentValidationStatus;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $documents=Document::orderBy('created_at','desc')->paginate(10);
        return view('back.pages.documents.index',compact('documents'));
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
    public function show( $slug)
    {
        //
        $document=Document::where('slug',$slug)->first();
        return view('back.pages.documents.show',compact('document'));
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

    public function validated( $slug)
    {
        //
        $document=Document::where('slug',$slug)->first();
        // Si le document est validé, retirer le rejet

        $document->is_validated = !$document->is_validated;
        if ($document->is_validated) {
            $document->is_rejected = false;
        }
        $document->save();

        $user = $document->user;
        $messageContent = '';

        // Si le document est validé
        if ($document->is_validated) {
            // Vérifier si tous les documents de l'utilisateur sont validés
            $allDocumentsValidated = $user->documents->every(function($doc) {
                return $doc->is_validated;
            });

            // Si tous les documents sont validés, on valide le compte utilisateur
            if ($allDocumentsValidated) {
                $user->status = true; // Compte validé
                // Message de confirmation de validation
                $messageContent = 'Tous vos documents ont été validés. Votre compte est maintenant validé.';
                // Envoyer l'email avec le message approprié
            Mail::to($user->email)->send(new DocumentValidationStatus($messageContent));
            }else {
                $user->status = false; // Désactiver le compte utilisateur
            }
            $user->save();
        }

        return redirect()->route('documents.index')->with('success', 'Le statut de validation du document a été mis à jour.');
    }


    public function reason(Request $request)
    {
        //
         // Récupérer l'ID du devis depuis le champ caché
        $docId = $request->document_id;

        // Trouver le devis dans la base de données
        $document = Document::find($docId);


        $document->update([
            'is_rejected'=>true,
            'reason'=>$request->reason
        ]);
        $user=$document->user;
        $user->status=false;
        $user->save();

        Mail::to($document->user->email)->send(new DocumentRejetStatus($document));
        // Rediriger avec un message de succès

        return redirect()->route('documents.index')->with('success', 'Le statut de validation du document a été rejeté.');

    }

}


