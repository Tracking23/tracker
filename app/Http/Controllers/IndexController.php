<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Website;

class IndexController extends Controller
{
    public function index()
    {
        $websites = Website::all();

        return view('index', compact('websites'));
    }
}
