<?php

namespace Baldcat\PlatformPerPage\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

trait PaginateControl
{

    /**
     *  Pagination scope
     *
     * @param  Builder  $query
     * @param  int|null  $perPage
     * @return LengthAwarePaginator
     */
    public function scopePpp(Builder $query, $perPage = null): LengthAwarePaginator
    {
        $perPage = $perPage ?? request('pp_page', config('platform-pp.options')[0]);

        return $query->paginate($perPage);
    }

}