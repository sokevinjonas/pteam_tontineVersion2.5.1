<?php

namespace App\Http\Controllers;

use App\Models\Classement;
use Illuminate\Http\Request;

class ClassementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classements = Classement::orderBy('created_at', 'desc')->get();

        return view('', compact('classements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return  view('');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Classement $classement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classement $classement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classement $classement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classement $classement)
    {
        //
    }
}
