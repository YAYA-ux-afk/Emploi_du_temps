<?php

namespace App\Http\Controllers;

use App\Models\TimetableLog;
use Illuminate\View\View;

class TimetableLogController extends Controller
{
    public function index(): View
    {
        // On récupère tous les logs du plus récent au plus ancien
        $logs = TimetableLog::orderBy('created_at', 'desc')->get();
        
        return view('welcome', compact('logs'));
    }
}