<?php
declare(strict_types=1);
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Traits\SendResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    use SendResponse;
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     */
    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Product::class);
        $products = Product::with('category')->latest()->paginate(20);
        return $this->success($products, 'Products list fetched successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = Product::query()->create($request->validated());
        return $this->success($product, 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     * @throws AuthorizationException
     */
    public function show(Product $product): JsonResponse
    {
        $this->authorize('view', $product);
        $product->load('category');
        return $this->success($product, 'Product fetched successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $product->update($request->validated());
        $product->load('category');
        return $this->success($product, 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * @throws AuthorizationException
     */
    public function destroy(Product $product): JsonResponse
    {
        $this->authorize('delete', $product);
        $product->delete();
        return $this->success([], 'Product deleted successfully.');
    }
}
