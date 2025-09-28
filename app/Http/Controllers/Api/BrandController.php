<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Brand::query();

        // Filter by active brands only for public API
        $query->where('is_active', true);

        // Search functionality
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('name', 'like', "%{$search}%");
        }

        // Include product count
        if ($request->boolean('with_products_count')) {
            $query->withCount('products');
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'name');
        $sortOrder = $request->get('sort_order', 'asc');

        $allowedSorts = ['name', 'created_at', 'updated_at'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder);
        }

        // Pagination
        $perPage = min($request->get('per_page', 15), 50);
        $brands = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $brands
        ]);
    }

    public function show($slug): JsonResponse
    {
        $brand = Brand::where('slug', $slug)
            ->where('is_active', true)
            ->withCount('products')
            ->first();

        if (!$brand) {
            return response()->json([
                'success' => false,
                'message' => 'Brand not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $brand
        ]);
    }

    public function products(Request $request, $slug): JsonResponse
    {
        $brand = Brand::where('slug', $slug)
            ->where('is_active', true)
            ->first();

        if (!$brand) {
            return response()->json([
                'success' => false,
                'message' => 'Brand not found'
            ], 404);
        }

        $query = $brand->products()->with(['category'])->where('is_active', true);

        // Search within brand products
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

        // Filter by price range
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->get('min_price'));
        }

        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->get('max_price'));
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'name');
        $sortOrder = $request->get('sort_order', 'asc');

        $allowedSorts = ['name', 'price', 'created_at'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder);
        }

        $perPage = min($request->get('per_page', 15), 50);
        $products = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => [
                'brand' => $brand,
                'products' => $products
            ]
        ]);
    }

//     // Admin methods
//     public function store(Request $request): JsonResponse
//     {
//         $validator = Validator::make($request->all(), [
//             'name' => 'required|string|max:255',
//             'image' => 'nullable|string',
//             'is_active' => 'boolean',
//         ]);

//         if ($validator->fails()) {
//             return response()->json([
//                 'success' => false,
//                 'message' => 'Validation errors',
//                 'errors' => $validator->errors()
//             ], 422);
//         }

//         $data = $request->all();
//         $data['slug'] = Str::slug($request->name);

//         // Ensure unique slug
//         $originalSlug = $data['slug'];
//         $count = 1;
//         while (Brand::where('slug', $data['slug'])->exists()) {
//             $data['slug'] = $originalSlug . '-' . $count;
//             $count++;
//         }

//         $brand = Brand::create($data);

//         return response()->json([
//             'success' => true,
//             'message' => 'Brand created successfully',
//             'data' => $brand
//         ], 201);
//     }

//     public function update(Request $request, Brand $brand): JsonResponse
//     {
//         $validator = Validator::make($request->all(), [
//             'name' => 'sometimes|required|string|max:255',
//             'image' => 'nullable|string',
//             'is_active' => 'boolean',
//         ]);

//         if ($validator->fails()) {
//             return response()->json([
//                 'success' => false,
//                 'message' => 'Validation errors',
//                 'errors' => $validator->errors()
//             ], 422);
//         }

//         $data = $request->all();

//         // Update slug if name is changed
//         if ($request->has('name') && $request->name !== $brand->name) {
//             $data['slug'] = Str::slug($request->name);

//             // Ensure unique slug
//             $originalSlug = $data['slug'];
//             $count = 1;
//             while (Brand::where('slug', $data['slug'])->where('id', '!=', $brand->id)->exists()) {
//                 $data['slug'] = $originalSlug . '-' . $count;
//                 $count++;
//             }
//         }

//         $brand->update($data);

//         return response()->json([
//             'success' => true,
//             'message' => 'Brand updated successfully',
//             'data' => $brand
//         ]);
//     }

//     public function destroy(Brand $brand): JsonResponse
//     {
//         // Check if brand has products
//         if ($brand->products()->count() > 0) {
//             return response()->json([
//                 'success' => false,
//                 'message' => 'Cannot delete brand with products'
//             ], 422);
//         }

//         $brand->delete();

//         return response()->json([
//             'success' => true,
//             'message' => 'Brand deleted successfully'
//         ]);
//     }

//     public function toggleActive(Brand $brand): JsonResponse
//     {
//         $brand->update(['is_active' => !$brand->is_active]);

//         return response()->json([
//             'success' => true,
//             'message' => 'Brand status updated successfully',
//             'data' => $brand
//         ]);
//     }
}