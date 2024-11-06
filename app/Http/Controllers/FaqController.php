<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\FaqType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $faqTypes = FaqType::all();

        return view('back.pages.faq.index',compact('faqTypes'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $faqTypes = FaqType::all();

        return view('back.pages.faq.create',compact('faqTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Validate the incoming request data
        $request->validate([
            'faq_type_id' => 'required|exists:faq_types,id',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        // Create a new ride entry in the database
            Faq::create([
            'faq_type_id' => $request->faq_type_id,
            'question' => $request->question,
            'answer' => $request->answer,
            'slug'=>Str::slug($request->question),
        ]);


        // Redirect back to a suitable route with a success message
        return redirect()->route('faqs.index')->with('success', 'Faq créé avec succès !');
    }


    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $slug)
    {
        //
        $faqTypes = FaqType::all();
        $faq=Faq::where('slug',$slug)->first();
       return view('back.pages.faq.edit', compact('faq', 'faqTypes'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$slug)
    {
        //


        // Validate the incoming request data
        $request->validate([
            'faq_type_id' => 'required|exists:faq_types,id',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $faq=Faq::where('slug',$slug)->first();

        // Create a new ride entry in the database
            $faq->update([
            'faq_type_id' => $request->faq_type_id,
            'question' => $request->question,
            'answer' => $request->answer,
            'slug'=>Str::slug($request->question),
        ]);

        return redirect()->route('faqs.index')->with('success', 'Faq a été mise a jour avec succès !');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        //
        $faq=Faq::where('slug',$slug)->first();
        $faq->delete();

        return redirect()->route('faqs.index')->with('success', 'Faq a été supprimé avec succès !');
    }
}
