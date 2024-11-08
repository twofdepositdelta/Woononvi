<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportType;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $reports=Report::orderBy('created_at','desc')->paginate(10);
        $reportypes=ReportType::orderBy('created_at','desc')->get();
        return view('back.pages.signaler.index',compact('reports','reportypes'));
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
    public function show(Report $report)
    {
        //

        return view('back.pages.signaler.show',compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }

    public function filterByType(Request $request)
    {
        // Récupérer le type de véhicule filtré
        $typeId = $request->input('type_id');

        // Si un type de véhicule est sélectionné, filtrer les véhicules
        if ($typeId) {
            $reports = Report::where('report_type_id', $typeId)->orderBy('created_at', 'desc')->get();
        } else {
            // Si aucun type n'est sélectionné, récupérer tous les véhicules
            $reports = Report::orderBy('created_at', 'desc')->get();
        }

        // Retourner la vue partielle de la table avec les véhicules filtrés
        return view('back.pages.signaler.table', compact('reports'));
    }
}
