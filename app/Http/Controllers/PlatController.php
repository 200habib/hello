<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlatRequest;
use App\Http\Requests\UpdatePlatRequest;
use App\Models\Plat;

class PlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $plats = Plat::all();

        return view('plats.index', compact('plats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
               
        return view('plats.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StorePlatRequest $request)
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('plats', 'public'); 
        }

        Plat::create([
            'nom' => $request->name,
            'recette' => $request->recette,
            'user_id' => 1,  
            'image' => $imagePath,  
        ]);

        return redirect()->route('plats.index')->with('success', 'Piatto creato con successo');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Plat $plat)
    {
        
        $plat = Plat::findOrFail($plat);

        return view('plats.show', compact('plat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plat $plat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlatRequest $request, Plat $plat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plat $plat)
    {
        //
    }
}
