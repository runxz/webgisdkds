<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->get();
        return view('news.index', compact('news'));
    }
    public function show(News $news)
{
    return view('news.show', compact('news'));
}

    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'nullable|string',
            'thumbnail' => 'nullable|url'
        ]);

        News::create($validated);
        return redirect()->route('news.index')->with('success', 'News created.');
    }

    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'nullable|string',
            'thumbnail' => 'nullable|url'
        ]);

        $news->update($validated);
        return redirect()->route('news.index')->with('success', 'News updated.');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('news.index')->with('success', 'News deleted.');
    }
}
