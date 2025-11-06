<?php

namespace App\Http\Controllers\Api\Concerns;

trait InteractsWithImages
{
    protected function makeStorageUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        $normalized = str_replace('\\', '/', $path);
        $normalized = trim($normalized);

        if ($normalized === '') {
            return null;
        }

        $normalized = preg_replace('#^storage/(app/)?public/#', '', $normalized) ?? $normalized;
        $normalized = preg_replace('#^(public/|storage/)+#', '', $normalized) ?? $normalized;

        $normalized = trim($normalized, '/');

        if ($normalized === '') {
            return null;
        }

        $segments = array_map('rawurlencode', explode('/', $normalized));

        return url('/storage/' . implode('/', $segments));
    }

    protected function normalizeImageList(mixed $value): array
    {
        if (is_array($value)) {
            return array_values(array_filter($value, fn ($item) => filled($item)));
        }

        return array_values(array_filter([$value], fn ($item) => filled($item)));
    }
}

