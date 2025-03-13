<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use Illuminate\Support\Carbon;

class VisitController extends Controller
{
    public function track(Request $request) {
        $request->validate([
            'page_url'   => 'required|string|max:255',
            'visitor_id' => 'required|string|max:255',
            'ip_address' => 'required|ip',
            'user_agent' => 'nullable|string',
            'referrer'   => 'nullable|string|max:255',
        ]);
    
        $today = now()->toDateString();
    
        $existingVisit = Visit::where('visitor_id', $request->input('visitor_id'))
            ->where('page_url', $request->input('page_url'))
            ->whereDate('visit_time', $today)
            ->exists();
    
        if ($existingVisit) {
            return response()->json(['message' => 'Visitor already recorded today'], 200);
        }
    
        Visit::create([
            'page_url'   => $request->input('page_url'),
            'visitor_id' => $request->input('visitor_id'),
            'ip_address' => $request->input('ip_address'),
            'user_agent' => $request->input('user_agent'),
            'referrer'   => $request->input('referrer'),
            'visit_time' => now(),
        ]);
    
        return response()->json(['message' => 'Visit recorded successfully'], 201);
    }
    
    public function stats(Request $request)
    {
        $request->validate([
            'page' => 'required|string|max:255',
            'from' => 'required|date',
            'to'   => 'required|date|after_or_equal:from',
        ]);

        $visits = Visit::where('page_url', $request->input('page'))
            ->whereDate('visit_time', '>=', $request->input('from'))
            ->whereDate('visit_time', '<=', $request->input('to'))
            ->distinct('visitor_id')
            ->count();

        return response()->json(['unique_visits' => $visits]);
    }
}