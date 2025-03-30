<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialLinkController extends Controller
{
    public function store(Request $request, $portfolioId)
    {
        $portfolio = Portfolio::findOrFail($portfolioId);
        $this->authorizeAccess($portfolio);

        $request->validate([
        'platform' => 'required|string|max:255',
        'url' => 'required|url|max:255',
        ]);
        $SocialLink = $portfolio->SocialLinks()->create($request->all());
        return response()->json($SocialLink, 200);
    }


    public function show($portfolioId)
    {
        $portfolio = Portfolio::findOrFail($portfolioId);
        $this->authorizeAccess($portfolio);

        $SocialLink = $portfolio->SocialLinks;

        if (!$SocialLink) {
            return response()->json(['message' => 'SocialLink section not found'], 404);
        }

        return response()->json($SocialLink, 200);
    }


    public function update(Request $request, $portfolioId, $SocialLinkId)
    {
        $portfolio = Portfolio::findOrFail($portfolioId);
        $this->authorizeAccess($portfolio);
        $SocialLink = $portfolio->SocialLinks()->findOrFail($SocialLinkId);

        $SocialLink->update($request->all());
        return response()->json($SocialLink);
    }

    public function destroy($portfolioId, $SocialLinkId)
    {
        $portfolio = Portfolio::findOrFail($portfolioId);
        $this->authorizeAccess($portfolio);
        $portfolio->SocialLinks()->findOrFail($SocialLinkId)->delete();

        return response()->json(['message' => 'this SocialLink deleted successfully']);
    }

    protected function authorizeAccess(Portfolio $portfolio)
    {
        if ($portfolio->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
    }
}