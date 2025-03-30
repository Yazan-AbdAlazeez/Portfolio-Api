<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function store(Request $request, $portfolioId)
    {
        $portfolio = Portfolio::findOrFail($portfolioId);
        $this->authorizeAccess($portfolio);

        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);
        $service = $portfolio->services()->create($request->all());
        return response()->json($service, 200);
    }


    public function show($portfolioId)
    {
        $portfolio = Portfolio::findOrFail($portfolioId);
        $this->authorizeAccess($portfolio);

        $service = $portfolio->services;

        if (!$service) {
            return response()->json(['message' => 'Service section not found'], 404);
        }

        return response()->json($service, 200);
    }


    public function update(Request $request, $portfolioId, $serviceId)
    {
        $portfolio = Portfolio::findOrFail($portfolioId);
        $this->authorizeAccess($portfolio);
        $service = $portfolio->services()->findOrFail($serviceId);

        $service->update($request->all());
        return response()->json($service);
    }

    public function destroy($portfolioId, $serviceId)
    {
        $portfolio = Portfolio::findOrFail($portfolioId);
        $this->authorizeAccess($portfolio);
        $portfolio->services()->findOrFail($serviceId)->delete();

        return response()->json(['message' => 'this service deleted successfully']);
    }

    protected function authorizeAccess(Portfolio $portfolio)
    {
        if ($portfolio->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
    }
}