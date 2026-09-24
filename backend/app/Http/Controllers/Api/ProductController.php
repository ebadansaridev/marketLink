<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        protected ProductRepositoryInterface $productRepo
    ) {}

    public function index(Request $request): JsonResponse
    {
        $products = $this->productRepo->filterProducts($request->all());
        return response()->json(ProductResource::collection($products)->response()->getData(true));
    }

    public function show(int $id): JsonResponse
    {
        $product = $this->productRepo->findOrFail($id)->load(['farmer', 'category', 'reviews.customer']);
        return response()->json(new ProductResource($product));
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $farmer = $request->user()->farmerProfile;
        if (!$farmer) {
            return response()->json(['message' => 'Only farmers can create products'], 403);
        }

        $data = $request->validated();
        $data['farmer_id'] = $farmer->farmer_id;

        $product = $this->productRepo->create($data);

        return response()->json([
            'message' => 'Product created',
            'product' => new ProductResource($product->load(['farmer', 'category'])),
        ], 201);
    }

    public function update(StoreProductRequest $request, int $id): JsonResponse
    {
        $product = $this->productRepo->findOrFail($id);

        if ($product->farmer_id !== $request->user()->farmerProfile?->farmer_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $updated = $this->productRepo->update($id, $request->validated());

        return response()->json([
            'message' => 'Product updated',
            'product' => new ProductResource($updated->load(['farmer', 'category'])),
        ]);
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $product = $this->productRepo->findOrFail($id);

        if ($product->farmer_id !== $request->user()->farmerProfile?->farmer_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $this->productRepo->delete($id);
        return response()->json(['message' => 'Product deleted']);
    }

    public function markSoldOut(Request $request, int $id): JsonResponse
    {
        $product = $this->productRepo->findOrFail($id);
        if ($product->farmer_id !== $request->user()->farmerProfile?->farmer_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $this->productRepo->markSoldOut($id);
        return response()->json(['message' => 'Marked as sold out']);
    }
}