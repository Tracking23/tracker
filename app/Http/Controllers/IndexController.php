<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Websites;

class IndexController extends Controller
{
    public function index()
    {
        $websites = Websites::all();

        return view('index', compact('websites'));
    }
}
