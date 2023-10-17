<?php

namespace App\Http\Controllers;

use App\Models\Tontine;
use Illuminate\Http\Request;
use App\Models\Participation;

class ParticipationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $participations = Participation::orderBy('created_at', 'desc');

        return view('', compact('participations'));
    }
    // public function cotiser(Participation $participation, Tontine $tontine)
    // {
    //     $participationId = $participation::where('user_id', $participation->id)->get();
    //     dd($participationId);
    //     $nbr_place = $tontine->currentMembersNumber();
        
    // }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

        return to_route('');
    }

    /**
     * Display the specified resource.
     */
    public function show(Participation $participation)
    {
        return view('', compact('participation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Participation $participation)
    // {
    //     return view('', compact('participation'));
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Participation $participation)
    // {
    //     $participation->update($request->all());

    //     return to_route('');
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Participation $participation)
    // {
    //     $participation->delete();

    //     return to_route('');
    // }
}
