<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\Website;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\DB;

class VisitController extends Controller
{
    public function track(Request $request) {
        $request->validate([
            'page_url'   => 'required|string|max:255',
            'visitor_id' => 'required|string|max:255',
            'ip_address' => 'required|ip',
            'user_agent' => 'nullable|string',
            'referrer'   => 'nullable|string|max:255',
            'client_id'   => 'required',
        ]);

        $pageUrl = $request->input('page_url');

        //**Check if the page URL has a scheme */
        if (!parse_url($pageUrl, PHP_URL_SCHEME)) {
            $pageUrl = 'http://' . $pageUrl;
        }

        /**Get the base URL */
        $parsedUrl = parse_url($pageUrl);
        $baseUrl = $parsedUrl['scheme'] . '://' . $parsedUrl['host'];

        $website = Website::where('url', $baseUrl)->first();

        if($website == null){
            return response()->json(['message' => 'Website not found'], 404);
        }

        //**Check if the client ID matches the website's client ID */
        if($website->client_id != $request->input('client_id')){
            return response()->json(['message' => 'Client ID does not match'], 403);
        }
    
        $today = now()->toDateString();
    
        /**Check if the visitor has already been recorded today */
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
            'website_id' => $website->id,
        ]);
    
        return response()->json(['message' => 'Visit recorded successfully'], 201);
    }


    public function getAnalytics(Request $request)
    {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required|after_or_equal:start_date',
            'website' => 'required|integer|exists:websites,id',
        ]);
        
        try {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
        
            /**Get the unique visitors for each page URL */
            $visits = Visit::where('website_id', $request->website)
                ->whereBetween('visit_time', [$startDate, $endDate])
                ->selectRaw('
                    page_url,
                    COUNT(DISTINCT visitor_id) as unique_visitors
                ')
                ->groupBy('page_url')
                ->get();
        
            /**Format the response */
            $data = $visits->map(function ($visit) {
                return [
                    'page_url' => $visit->page_url,
                    'unique_visitors' => $visit->unique_visitors,
                ];
            });
        
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Invalid date format. Please use YYYY-MM-DD format.',
                'details' => $e->getMessage()
            ], 422);
        }
        
    }

    

}