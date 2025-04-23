<?php
namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    // Admin: list all reports
    public function index()
    {
        $reports = Report::with(['user', 'region'])->latest()->get();
        return view('reports.index', compact('reports'));
    }

    // Public: show form to submit a report
    public function create()
    {
        $regions = Region::all();
        return view('reports.create', compact('regions'));
    }

    // Public: store new report
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'region_id' => 'required|exists:regions,id',
        ]);

        $validated['user_id'] = Auth::id();
        Report::create($validated);

        return redirect()->route('dashboard')->with('success', 'Report submitted.');
    }

    // Admin/Public: view one report
    public function show(Report $report)
    {
        return view('reports.show', compact('report'));
    }

    // Admin: show edit form
    public function edit(Report $report)
    {
        $regions = Region::all();
        return view('reports.edit', compact('report', 'regions'));
    }

    // Admin: update report
    public function update(Request $request, Report $report)
    {
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'status' => 'required|in:pending,verified,rejected',
            'region_id' => 'required|exists:regions,id',
        ]);

        $report->update($validated);
        return redirect()->route('reports.index')->with('success', 'Report updated.');
    }

    // Admin: delete report
    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Report deleted.');
    }
}
