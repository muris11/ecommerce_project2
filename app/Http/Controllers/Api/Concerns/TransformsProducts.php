<?php

namespace App\Http\Controllers\Api\Concerns;

use App\Models\Product;

trait TransformsProducts
{
    use InteractsWithImages;

    protected function transformProduct(Product $product): array
    {
        $images = $this->normalizeImageList($product->image ?? null);

        $imageUrls = collect($images)
            ->map(fn ($path) => $this->makeStorageUrl($path))
            ->filter()
            ->values()
            ->all();

        return [
            'id' => $product->id,
            'slug' => $product->slug,
            'name' => $product->name,
            'description' => $product->description,
            'price' => (float) $product->price,
            'in_stock' => (bool) $product->in_stock,
            'is_active' => (bool) $product->is_active,
            'is_featured' => (bool) $product->is_featured,
            'on_sale' => (bool) $product->on_sale,
            'category' => $product->relationLoaded('category') && $product->category ? [
                'id' => $product->category->id,
                'name' => $product->category->name,
                'slug' => $product->category->slug,
            ] : null,
            'brand' => $product->relationLoaded('brand') && $product->brand ? [
                'id' => $product->brand->id,
                'name' => $product->brand->name,
                'slug' => $product->brand->slug,
            ] : null,
            'image_urls' => $imageUrls,
            'primary_image_url' => $imageUrls[0] ?? null,
            'created_at' => optional($product->created_at)->toIso8601String(),
            'updated_at' => optional($product->updated_at)->toIso8601String(),
        ];
    }
}

