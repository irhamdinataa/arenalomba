<?php

use Illuminate\Support\Str;

if (!function_exists('generateUniqueSlug')) {
    /**
     * Generate unique slug berdasarkan judul.
     *
     * @param string $title Judul yang akan diubah menjadi slug
     * @param string $model Class model (contoh: Post::class)
     * @param int|null $id ID yang di-exclude (untuk update)
     * @return string Slug yang unik
     */
    function generateUniqueSlug(string $title, string $model, ?int $id = null): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 2;
        
        // Cek apakah sudah ada slug yang sama di database
        while ($model::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }
        
        return $slug;
    }
}