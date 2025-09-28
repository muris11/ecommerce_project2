<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Product::with(['category', 'brand']);

        // Filter by active products only for public API
        $query->where('is_active', true);

        // Search functionality
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->has('category_id')) {
            $query->where('category_id', $request->get('category_id'));
        }

        // Filter by brand
        if ($request->has('brand_id')) {
            $query->where('brand_id', $request->get('brand_id'));
        }

        // Filter by price range
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->get('min_price'));
        }

        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->get('max_price'));
        }

        // Filter by featured
        if ($request->has('featured')) {
            $query->where('is_featured', $request->boolean('featured'));
        }

        // Filter by on sale
        if ($request->has('on_sale')) {
            $query->where('on_sale', $request->boolean('on_sale'));
        }

        // Filter by in stock
        if ($request->has('in_stock')) {
            $query->where('in_stock', $request->boolean('in_stock'));
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        $allowedSorts = ['name', 'price', 'created_at', 'updated_at'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder);
        }

        // Pagination
        $perPage = min($request->get('per_page', 15), 50); // Max 50 items per page
        $products = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $products,
            'meta' => [
                'total' => $products->total(),
                'per_page' => $products->perPage(),
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
            ]
        ]);
    }

    public function show($slug): JsonResponse
    {
        $product = Product::with(['category', 'brand'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->first();

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }

    public function featured(Request $request): JsonResponse
    {
        $query = Product::with(['category', 'brand'])
            ->where('is_active', true)
            ->where('is_featured', true);

        $perPage = min($request->get('per_page', 12), 50);
        $products = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    public function onSale(Request $request): JsonResponse
    {
        $query = Product::with(['category', 'brand'])
            ->where('is_active', true)
            ->where('on_sale', true);

        $perPage = min($request->get('per_page', 12), 50);
        $products = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    // // Admin methods
    // public function store(Request $request): JsonResponse
    // {
    //     $validator = Validator::make($request->all(), [
    //         'category_id' => 'required|exists:categories,id',
    //         'brand_id' => 'required|exists:brands,id',
    //         'name' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'price' => 'required|numeric|min:0',
    //         'image' => 'required|array',
    //         'image.*' => 'string',
    //         'is_active' => 'boolean',
    //         'is_featured' => 'boolean',
    //         'in_stock' => 'boolean',
    //         'on_sale' => 'boolean',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Validation errors',
    //             'errors' => $validator->errors()
    //         ], 422);
    //     }

    //     $data = $request->all();
    //     $data['slug'] = Str::slug($request->name);

    //     // Ensure unique slug
    //     $originalSlug = $data['slug'];
    //     $count = 1;
    //     while (Product::where('slug', $data['slug'])->exists()) {
    //         $data['slug'] = $originalSlug . '-' . $count;
    //         $count++;
    //     }

    //     $product = Product::create($data);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Product created successfully',
    //         'data' => $product->load(['category', 'brand'])
    //     ], 201);
    // }

    // public function update(Request $request, Product $product): JsonResponse
    // {
    //     $validator = Validator::make($request->all(), [
    //         'category_id' => 'sometimes|required|exists:categories,id',
    //         'brand_id' => 'sometimes|required|exists:brands,id',
    //         'name' => 'sometimes|required|string|max:255',
    //         'description' => 'sometimes|required|string',
    //         'price' => 'sometimes|required|numeric|min:0',
    //         'image' => 'sometimes|required|array',
    //         'image.*' => 'string',
    //         'is_active' => 'boolean',
    //         'is_featured' => 'boolean',
    //         'in_stock' => 'boolean',
    //         'on_sale' => 'boolean',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Validation errors',
    //             'errors' => $validator->errors()
    //         ], 422);
    //     }

    //     $data = $request->all();

    //     // Update slug if name is changed
    //     if ($request->has('name') && $request->name !== $product->name) {
    //         $data['slug'] = Str::slug($request->name);

    //         // Ensure unique slug
    //         $originalSlug = $data['slug'];
    //         $count = 1;
    //         while (Product::where('slug', $data['slug'])->where('id', '!=', $product->id)->exists()) {
    //             $data['slug'] = $originalSlug . '-' . $count;
    //             $count++;
    //         }
    //     }

    //     $product->update($data);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Product updated successfully',
    //         'data' => $product->load(['category', 'brand'])
    //     ]);
    // }

    // public function destroy(Product $product): JsonResponse
    // {
    //     $product->delete();

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Product deleted successfully'
    //     ]);
    // }

    // public function toggleActive(Product $product): JsonResponse
    // {
    //     $product->update(['is_active' => !$product->is_active]);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Product status updated successfully',
    //         'data' => $product
    //     ]);
    // }

    // public function toggleFeatured(Product $product): JsonResponse
    // {
    //     $product->update(['is_featured' => !$product->is_featured]);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Product featured status updated successfully',
    //         'data' => $product
    //     ]);
    // }
}