<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

trait HasSorts
{
    public static function applySorts($sort)
    {
        if (! $sort) {
            return static::query();
        }

        $allowedSorts = ['title', 'content'];

        $query = static::query();

        foreach (explode(',', $sort) as $sortField) {
            $direction = 'asc';

            if (str_starts_with($sortField, '-')) {
                $direction = 'desc';
                $sortField = substr($sortField, 1);
            }

            if (! in_array($sortField, $allowedSorts)) {
                abort(400, "Invalid sort field: {$sortField}");
            }

            $query->orderBy($sortField, $direction);
        }

        return $query;
    }

}