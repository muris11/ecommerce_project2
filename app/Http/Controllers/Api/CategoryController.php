<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Concerns\InteractsWithImages;
use App\Http\Controllers\Api\Concerns\TransformsProducts;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use InteractsWithImages;
    use TransformsProducts;

    public function index(Request $request): JsonResponse
    {
        $perPage = (int) $request->integer('per_page', 0);
        $perPage = $perPage > 0 ? min($perPage, 100) : 0;

        $query = Category::query()
            ->where('is_active', 1)
            ->withCount(['products as products_count' => fn ($q) => $q->where('is_active', 1)]);

        if ($search = $request->string('search')->trim()) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $sort = $request->input('sort', 'name');
        match ($sort) {
            'latest' => $query->orderByDesc('created_at'),
            default => $query->orderBy('name'),
        };

        if ($perPage > 0) {
            $paginator = $query->paginate($perPage)->withQueryString();

            $data = $paginator->getCollection()
                ->map(fn (Category $category) => $this->transformCategory($category))
                ->all();

            return response()->json([
                'data' => $data,
                'meta' => [
                    'current_page' => $paginator->currentPage(),
                    'per_page' => $paginator->perPage(),
                    'total' => $paginator->total(),
                    'last_page' => $paginator->lastPage(),
                    'has_more_pages' => $paginator->hasMorePages(),
                ],
            ]);
        }

        $categories = $query->get();

        $data = $categories
            ->map(fn (Category $category) => $this->transformCategory($category))
            ->all();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function show(Request $request, Category $category): JsonResponse
    {
        abort_if(!$category->is_active, 404);

        $category->loadCount(['products as products_count' => fn ($q) => $q->where('is_active', 1)]);

        $data = $this->transformCategory($category);

        if ($request->boolean('with_products')) {
            $perPage = (int) $request->integer('per_page', 12);
            $perPage = $perPage > 0 ? min($perPage, 50) : 12;

            $productQuery = $category->products()
                ->where('is_active', 1)
                ->with([
                    'category:id,name,slug',
                    'brand:id,name,slug',
                ]);

            if ($request->boolean('featured')) {
                $productQuery->where('is_featured', 1);
            }

            if ($request->boolean('on_sale')) {
                $productQuery->where('on_sale', 1);
            }

            if ($request->filled('min_price')) {
                $productQuery->where('price', '>=', (float) $request->input('min_price'));
            }

            if ($request->filled('max_price')) {
                $productQuery->where('price', '<=', (float) $request->input('max_price'));
            }

            $sort = $request->input('sort', 'latest');
            match ($sort) {
                'price_asc' => $productQuery->orderBy('price'),
                'price_desc' => $productQuery->orderByDesc('price'),
                'oldest' => $productQuery->orderBy('created_at'),
                default => $productQuery->latest(),
            };

            $paginator = $productQuery->paginate($perPage)->withQueryString();

            $products = $paginator->getCollection()
                ->map(fn ($product) => $this->transformProduct($product))
                ->all();

            $data['products'] = [
                'data' => $products,
                'meta' => [
                    'current_page' => $paginator->currentPage(),
                    'per_page' => $paginator->perPage(),
                    'total' => $paginator->total(),
                    'last_page' => $paginator->lastPage(),
                    'has_more_pages' => $paginator->hasMorePages(),
                ],
            ];
        }

        return response()->json([
            'data' => $data,
        ]);
    }

    private function transformCategory(Category $category): array
    {
        return [
            'id' => $category->id,
            'slug' => $category->slug,
            'name' => $category->name,
            'image_url' => $this->makeStorageUrl($category->image),
            'products_count' => $category->products_count ?? 0,
            'created_at' => optional($category->created_at)->toIso8601String(),
            'updated_at' => optional($category->updated_at)->toIso8601String(),
        ];
    }
}

