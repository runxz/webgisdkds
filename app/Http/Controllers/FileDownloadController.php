<?php
namespace App\Http\Controllers;

use App\Models\FileDownload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileDownloadController extends Controller
{
    public function index()
    {
        $downloads = FileDownload::all();
        return view('downloads.index', compact('downloads'));
    }

    public function create()
    {
        return view('downloads.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'category' => 'nullable|string',
            'file' => 'required|file|max:10240' // 10MB max
        ]);

        $path = $request->file('file')->store('files', 'public');

        FileDownload::create([
            'title' => $validated['title'],
            'category' => $validated['category'] ?? null,
            'file_path' => $path,
        ]);

        return redirect()->route('downloads.index')->with('success', 'File uploaded.');
    }

    public function edit(FileDownload $download)
    {
        return view('downloads.edit', compact('download'));
    }

    public function update(Request $request, FileDownload $download)
    {
        $validated = $request->validate([
            'title' => 'required',
            'category' => 'nullable|string',
            'file' => 'nullable|file|max:10240'
        ]);

        if ($request->hasFile('file')) {
            // Delete old
            Storage::disk('public')->delete($download->file_path);
            $validated['file_path'] = $request->file('file')->store('files', 'public');
        }

        $download->update($validated);
        return redirect()->route('downloads.index')->with('success', 'File updated.');
    }

    public function destroy(FileDownload $download)
    {
        Storage::disk('public')->delete($download->file_path);
        $download->delete();
        return redirect()->route('downloads.index')->with('success', 'File deleted.');
    }
}
