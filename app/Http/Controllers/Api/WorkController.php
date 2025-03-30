<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkController extends Controller
{
    public function show($portfolioId)
    {
        $portfolio = Portfolio::findOrFail($portfolioId);
        $this->authorizeAccess($portfolio);
        $work = $portfolio->works;

        if (!$work) {
            return response()->json(['message' => 'work section not found'], 404);
        }

        return response()->json($work, 200);
    }

    public function store(Request $request, $portfolioId)
    {
        $portfolio = Portfolio::findOrFail($portfolioId);
        $this->authorizeAccess($portfolio);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_path' => 'nullable|string',
            'link' => 'nullable|url',
        ]);

        $work = $portfolio->works()->create($request->all());
        return response()->json($work);
    }

    public function update(Request $request, $portfolioId, $workId)
    {
        $portfolio = Portfolio::findOrFail($portfolioId);
        $this->authorizeAccess($portfolio);
        $work = $portfolio->works()->findOrFail($workId);

        $work->update($request->all());
        return response()->json($work);
    }

    public function destroy($portfolioId, $workId)
    {
        $portfolio = Portfolio::findOrFail($portfolioId);
        $this->authorizeAccess($portfolio);
        $portfolio->works()->findOrFail($workId)->delete();

        return response()->json(['message' => 'Deleted']);
    }

    protected function authorizeAccess(Portfolio $portfolio)
    {
        if ($portfolio->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
    }
}
