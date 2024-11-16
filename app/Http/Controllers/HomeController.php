<?php

namespace App\Http\Controllers;

use App\Models\FaqType;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('front.pages.index');
    }

    public function faqs()
{
   
    $faqGroups = FaqType::orderBy('created_at','desc')->get();

    return view('front.pages.documentation.faq', compact('faqGroups'));
}
}
