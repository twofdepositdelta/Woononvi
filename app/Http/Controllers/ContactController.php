<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Helpers\BackHelper;
use Illuminate\Http\Request;
use App\Mail\SendContactMail;
use App\Mail\ReceiveContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
          //
          if (auth()->user()->hasRole('support')) {

            $auth_user = auth()->user();
            $auth_country_id = $auth_user->city->country->id ?? null; // Assure-toi que ces relations existent
            // Vérifier si le pays a été trouvé
                if ($auth_country_id) {
                    // Récupérer les trajets où le conducteur appartient au même pays
                    $contacts=Contact::where('country_id', $auth_country_id)->orderBy('created_at', 'desc')
                      ->paginate(10);

                }

        }else{

            $selectedCountry = session('selected_country', 'benin'); // Par défaut 'benin' si rien n'est sélectionné
            // Récupérer l'ID du pays basé sur le pays sélectionné
            $countryName = BackHelper::getCountryByName($selectedCountry);
            $countryid =$countryName->id;

            $contacts=Contact::where('country_id', $countryid)->orderBy('created_at', 'desc')
              ->paginate(10);

        }
        return view('back.pages.contact.index',compact('contacts'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('front.pages.contact');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'fullname' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['required'],
            'subject' => ['required', 'string'],
            'message' => ['required', 'string'],
            'country_code'=>['required']

        ]);

        $data = Contact::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'country_id'=>$request->country_code
        ]);

        Mail::to('wononvi@gmail.com')->send(new ReceiveContactMail($data));
        Mail::to($data['email'])->send(new SendContactMail($data));

    // Redirection avec un message de succès
    return redirect()->back()->with('success', 'Votre message a été envoyé avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show( $email)
    {
        //
        $contact=Contact::where('email',$email)->first();
        return view('back.pages.contact.show',compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($email)
    {
        //
        $contact=Contact::where('email',$email)->first();
        $contact->delete();
       return redirect()->back()->with('success', 'le contacte a été supprimé  avec succès !');


    }
}
