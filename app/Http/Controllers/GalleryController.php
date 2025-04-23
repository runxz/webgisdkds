<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;


class GalleryController extends Controller
{
  
    public function index()
{
    $galleries = \App\Models\Gallery::all();
    return view('galleries.index', compact('galleries'));
}

public function create()
{
    return view('galleries.create');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required',
        'media_type' => 'required|in:photo,video',
        'media_url' => 'required|url',
        'description' => 'nullable'
    ]);

    \App\Models\Gallery::create($validated);
    return redirect()->route('galleries.index')->with('success', 'Media added.');
}

}
