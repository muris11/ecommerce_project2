<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Controllers\Api\Concerns\TransformsProducts;
use App\Http\Controllers\Api\Concerns\InteractsWithImages;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use TransformsProducts;
    use InteractsWithImages;

    public function index(Request $request): JsonResponse
    {
        $perPage = (int) $request->integer('per_page', 12);
        $perPage = $perPage > 0 ? min($perPage, 50) : 12;

        $query = Product::query()
            ->where('is_active', 1)
            ->with([
                'category:id,name,slug',
                'brand:id,name,slug',
            ]);

        if ($search = $request->string('search')->trim()) {
            $query->where(fn ($q) => $q
                ->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%'));
        }

        if ($categories = $this->normalizeList($request->input('categories') ?? $request->input('category'))) {
            $ids = $this->extractIds($categories);
            $slugs = $this->extractSlugs($categories);

            $query->where(function ($q) use ($ids, $slugs) {
                if (!empty($ids)) {
                    $q->whereIn('category_id', $ids);
                }

                if (!empty($slugs)) {
                    $method = empty($ids) ? 'whereHas' : 'orWhereHas';
                    $q->{$method}('category', fn ($sub) => $sub->whereIn('slug', $slugs));
                }
            });
        }

        if ($brands = $this->normalizeList($request->input('brands') ?? $request->input('brand'))) {
            $ids = $this->extractIds($brands);
            $slugs = $this->extractSlugs($brands);

            $query->where(function ($q) use ($ids, $slugs) {
                if (!empty($ids)) {
                    $q->whereIn('brand_id', $ids);
                }

                if (!empty($slugs)) {
                    $method = empty($ids) ? 'whereHas' : 'orWhereHas';
                    $q->{$method}('brand', fn ($sub) => $sub->whereIn('slug', $slugs));
                }
            });
        }

        if ($request->boolean('featured')) {
            $query->where('is_featured', 1);
        }

        if ($request->boolean('on_sale')) {
            $query->where('on_sale', 1);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', (float) $request->input('min_price'));
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', (float) $request->input('max_price'));
        }

        $sort = $request->input('sort', 'latest');
        match ($sort) {
            'price_asc' => $query->orderBy('price'),
            'price_desc' => $query->orderByDesc('price'),
            'oldest' => $query->orderBy('created_at'),
            default => $query->latest(),
        };

        $paginator = $query->paginate($perPage)->withQueryString();

        $data = $paginator->getCollection()
            ->map(fn (Product $product) => $this->transformProduct($product))
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

    public function show(Product $product): JsonResponse
    {
        abort_if(!$product->is_active, 404);

        $product->loadMissing([
            'category:id,name,slug',
            'brand:id,name,slug',
        ]);

        return response()->json([
            'data' => $this->transformProduct($product),
        ]);
    }
    
    private function normalizeList(mixed $value): array
    {
        if (is_null($value)) {
            return [];
        }

        if (is_array($value)) {
            return array_filter($value, fn ($item) => filled($item));
        }

        if (is_string($value)) {
            return array_filter(array_map('trim', explode(',', $value)));
        }

        return [(string) $value];
    }

    private function extractIds(array $values): array
    {
        return array_values(array_filter($values, fn ($value) => is_numeric($value)));
    }

    private function extractSlugs(array $values): array
    {
        return array_values(array_filter($values, fn ($value) => !is_numeric($value)));
    }
}
