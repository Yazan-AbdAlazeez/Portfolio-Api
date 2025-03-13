<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolio = Portfolio::with(['about', 'works', 'services', 'contact', 'socialLinks'])->findOrFail($id);
        return response()->json($portfolio,200);
    }
}
