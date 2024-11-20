<?php

namespace App\Http\Controllers;

use App\Models\FaqType;
use App\Models\Actuality;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('front.pages.index');
    }



    public function functioning()
    {

        return view('front.pages.documentation.fonctionnement');
    }

    public function joinUs()
    {

        return view('front.pages.joinUs');
    }

    public function security()
    {

        return view('front.pages.about.security');
    }
    public function about()
    {
        return view('front.pages.about');
    }

    public function new()
    {
        $actualities = Actuality::orderBy('created_at', 'desc')->paginate(15);
        return view('front.pages.actualities.index', compact('actualities'));
    }

    public function faqs()
    {

        $faqGroups = FaqType::orderBy('created_at','desc')->get();

        return view('front.pages.documentation.faq', compact('faqGroups'));
    }

    public function newSow(Actuality $actuality)
    {
        $otherNews = Actuality::where('id', '!=', $actuality->id)
                        ->orderBy('created_at', 'desc')
                        ->limit(10)
                        ->get();
        return view('front.pages.actualities.show', compact('actuality', 'otherNews'));
    }

    public function download(Actuality $actuality)
    {
        return view('front.pages.download');
    }

    public function condition()
    {
        return view('front.pages.rgpg.condition');
    }

    public function privacy()
    {
        return view('front.pages.rgpg.privacy');
    }
}