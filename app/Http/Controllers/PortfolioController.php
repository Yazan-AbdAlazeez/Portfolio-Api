<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    // public function show($id)
    // {
    //     $portfolio = Portfolio::with(['about', 'works', 'services', 'contact', 'socialLinks'])->findOrFail($id);
    //     return response()->json($portfolio);
    // }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'profile_image' => 'nullable|string',
    //     ]);

    //     $portfolio = $request->user()->portfolios()->create($validated);
    //     return response()->json($portfolio);
    // }

    // public function update(Request $request, $id)
    // {
    //     $portfolio = Portfolio::findOrFail($id);
    //     $this->authorizeAccess($portfolio);

    //     $portfolio->update($request->only(['title', 'profile_image']));
    //     return response()->json($portfolio);
    // }

    // protected function authorizeAccess(Portfolio $portfolio)
    // {
    //     if ($portfolio->user_id !== Auth::id()) {
    //         abort(403, 'Unauthorized');
    //     }
    // }
}
