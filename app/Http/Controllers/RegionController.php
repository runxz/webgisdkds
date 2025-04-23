<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Region;
use Illuminate\Support\Facades\Auth;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::all();
        return view('regions.index', compact('regions'));
    }
    
    public function create()
    {
        return view('regions.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'description' => 'nullable',
            'geometry' => 'nullable|json',
        ]);
        Region::create($validated);
        return redirect()->route('regions.index');
    }
    
    public function show(Region $region)
    {
        return view('regions.show', compact('region'));
    }
    
    public function edit(Region $region)
    {
        return view('regions.edit', compact('region'));
    }
    
    public function update(Request $request, Region $region)
    {
        $validated = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'description' => 'nullable',
            'geometry' => 'nullable|json',
        ]);
        $region->update($validated);
        return redirect()->route('regions.index');
    }
    
    public function destroy(Region $region)
    {
        $region->delete();
        return redirect()->route('regions.index');
    }
    
}
