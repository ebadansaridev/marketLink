<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $favorites = Favorite::with(['product', 'farmer'])
            ->where('customer_id', $request->user()->user_id)
            ->get();

        return response()->json($favorites);
    }

    public function toggle(Request $request): JsonResponse
    {
        $data = $request->validate([
            'product_id' => 'nullable|exists:products,product_id',
            'farmer_id'  => 'nullable|exists:farmer_profiles,farmer_id',
        ]);

        if (empty($data['product_id']) && empty($data['farmer_id'])) {
            return response()->json(['message' => 'Provide product_id or farmer_id'], 422);
        }

        $data['customer_id'] = $request->user()->user_id;

        $existing = Favorite::where($data)->first();
        if ($existing) {
            $existing->delete();
            return response()->json(['message' => 'Removed from favorites']);
        }

        Favorite::create($data);
        return response()->json(['message' => 'Added to favorites'], 201);
    }
}