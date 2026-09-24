<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\MarketRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function __construct(
        protected MarketRepositoryInterface $marketRepo
    ) {}

    public function index(): JsonResponse
    {
        return response()->json($this->marketRepo->all());
    }

    public function show(int $id): JsonResponse
    {
        $market = $this->marketRepo->findOrFail($id)->load('farmers.products');
        return response()->json($market);
    }

    public function nearby(Request $request): JsonResponse
    {
        $request->validate([
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius'    => 'nullable|numeric|min:1|max:100',
        ]);

        $markets = $this->marketRepo->findNearby(
            $request->latitude,
            $request->longitude,
            $request->radius ?? 10
        );

        return response()->json($markets);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'market_name'    => 'required|string|max:100',
            'address'        => 'required|string',
            'latitude'       => 'nullable|numeric',
            'longitude'      => 'nullable|numeric',
            'map_provider'   => 'nullable|string|max:30',
            'operating_days' => 'nullable|string|max:100',
            'timings'        => 'nullable|string|max:100',
        ]);

        $market = $this->marketRepo->create($data);
        return response()->json(['message' => 'Market created', 'market' => $market], 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $data = $request->validate([
            'market_name'    => 'sometimes|string|max:100',
            'address'        => 'sometimes|string',
            'latitude'       => 'nullable|numeric',
            'longitude'      => 'nullable|numeric',
            'operating_days' => 'nullable|string',
            'timings'        => 'nullable|string',
        ]);

        $market = $this->marketRepo->update($id, $data);
        return response()->json(['message' => 'Market updated', 'market' => $market]);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->marketRepo->delete($id);
        return response()->json(['message' => 'Market deleted']);
    }
}