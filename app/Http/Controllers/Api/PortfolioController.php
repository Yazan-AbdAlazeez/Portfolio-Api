<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PortfolioController extends Controller
{
    // public function index()
    // {
    //     $portfolio = Portfolio::with(['about', 'works', 'services', 'contact', 'socialLinks'])->findOrFail($id);
    //     return response()->json($portfolio,200);
    // }
    public function index()
    {
        $portfolio = portfolio::all();
        return response()->json($portfolio, 200);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'profile_image' => 'image|required',
        ]);
        $imageName = $request->file("profile_image")->store('image',"public");
        $portfolio = new Portfolio();
        $portfolio->title = $validatedData['title'];
        $portfolio->photo = $imageName;
        $portfolio->save();
        return response()->json(["message" => "portfolio added", "portfolio" => $portfolio], 201);
    }

    public function show($id)
    {
        $portfolio = portfolio::where("id", $id)->first();
        if ($portfolio) {
            return response()->json($portfolio, 200);
        }
        return response()->json(["message" => "portfolio not found"], 404);
    }
    public function update(Request $request, $id)
    {
        try {
            // Log the incoming request data
            Log::info("Incoming request data: ", $request->all());

            // Validate the request data
            $validatedData = $request->validate([
                'title' => 'string',
                'profile_image' => 'image',
            ]);

            // Find the category by ID
            $portfolio = portfolio::find($id);
            if (!$portfolio) {
                Log::error("portfolio not found for ID: $id");
                return response()->json(["message" => "portfolio not found"], 404);
            }

            // Handle the photo upload
            if ($request->hasFile('profile_image')) {
                Log::info("profile_image upload initiated for portfolio ID: $id");

                $imageName = $request->file("profile_image")->getClientOriginalName() . "." . time() . "." . $request->file("profile_image")->getClientOriginalExtension();
                $request->file("profile_image")->move(public_path("/image/portfolio"), $imageName);

                // Update the category with the new photo
                $portfolio->profile_image = $imageName;
                Log::info("profile_image updated to: $imageName for portfolio ID: $id");
            } else {
                Log::warning("No profile_image uploaded for portfolio ID: $id");
            }

            // Update the title
            $portfolio->title = $validatedData['title'];
            $portfolio->save();

            Log::info("portfolio updated successfully: ", $portfolio->toArray());

            return response()->json(["message" => "portfolio updated", "portfolio" => $portfolio], 200);
        } catch (\Exception $e) {
            Log::error("Error updating portfolio ID: $id. Error: " . $e->getMessage());
            return response()->json(["message" => "An error occurred while updating the portfolio."], 500);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $portfolio = portfolio::find($id);
        if ($portfolio) {
            $portfolio->delete();
            return response()->json(["message" => "portfolio deleted"], 200);
        }
        return response()->json(["message" => "portfolio not found"], 404);
    }

}
