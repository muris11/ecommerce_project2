<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Category::query();

        // Filter by active categories only for public API
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
        $categories = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    public function show($slug): JsonResponse
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->withCount('products')
            ->first();

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }

    public function products(Request $request, $slug): JsonResponse
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->first();

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }

        $query = $category->products()->with(['brand'])->where('is_active', true);

        // Search within category products
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
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
                'category' => $category,
                'products' => $products
            ]
        ]);
    }

    // // Admin methods
    // public function store(Request $request): JsonResponse
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'image' => 'nullable|string',
    //         'is_active' => 'boolean',
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
    //     while (Category::where('slug', $data['slug'])->exists()) {
    //         $data['slug'] = $originalSlug . '-' . $count;
    //         $count++;
    //     }

    //     $category = Category::create($data);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Category created successfully',
    //         'data' => $category
    //     ], 201);
    // }

    // public function update(Request $request, Category $category): JsonResponse
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'sometimes|required|string|max:255',
    //         'image' => 'nullable|string',
    //         'is_active' => 'boolean',
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
    //     if ($request->has('name') && $request->name !== $category->name) {
    //         $data['slug'] = Str::slug($request->name);

    //         // Ensure unique slug
    //         $originalSlug = $data['slug'];
    //         $count = 1;
    //         while (Category::where('slug', $data['slug'])->where('id', '!=', $category->id)->exists()) {
    //             $data['slug'] = $originalSlug . '-' . $count;
    //             $count++;
    //         }
    //     }

    //     $category->update($data);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Category updated successfully',
    //         'data' => $category
    //     ]);
    // }

    // public function destroy(Category $category): JsonResponse
    // {
    //     // Check if category has products
    //     if ($category->products()->count() > 0) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Cannot delete category with products'
    //         ], 422);
    //     }

    //     $category->delete();

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Category deleted successfully'
    //     ]);
    // }

    // public function toggleActive(Category $category): JsonResponse
    // {
    //     $category->update(['is_active' => !$category->is_active]);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Category status updated successfully',
    //         'data' => $category
    //     ]);
    // }
}