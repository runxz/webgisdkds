<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Report;
use App\Models\Region;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => \App\Models\User::count(),
            'regions' => \App\Models\Region::count(),
            'reports' => [
                'total' => \App\Models\Report::count(),
                'pending' => \App\Models\Report::where('status', 'pending')->count(),
                'verified' => \App\Models\Report::where('status', 'verified')->count(),
                'rejected' => \App\Models\Report::where('status', 'rejected')->count(),
            ]
        ];
    
        return view('admin.dashboard', compact('stats'));
    }
}
