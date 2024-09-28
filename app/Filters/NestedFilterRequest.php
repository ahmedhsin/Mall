<?php

namespace App\Filters;

use Closure;
use Illuminate\Support\Str;

class NestedFilterRequest
{
    public function handle($request, Closure $next)
    {
        $filter = class_basename($this);

        $filter = str_replace('Filter', '', $filter);
        $filter = Str::snake($filter);
        if (request()->filled($filter)) {
            $value = request($filter);
            if (Str::contains($filter, '.')) {
                $filterParts = explode('.', $filter);
                return $next($request)->whereHas($filterParts[0], function ($query) use ($filterParts, $value) {
                    $query->where($filterParts[1], $value);
                });
            }

            return $next($request)->where($filter, $value);
        }

        return $next($request);
    }
}
