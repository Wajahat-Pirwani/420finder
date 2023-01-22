<?php

namespace App\Scoping\Scopes\MapScopes;

use App\Scoping\Contracts\Scope;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class MapSortScope implements Scope
{
    public function apply(Builder $builder, $value)
    {

        if($value == 'highest-rated') {

          return $builder->orderBy('rating', 'desc');

        } else if($value == 'most-reviewed') {

          return $builder->orderBy('reviewCount', 'desc');

        } else if($value == 'name-a-to-z') {

          return $builder->orderBy('business_name', 'asc');

        } else if($value == 'name-z-to-a') {

          return $builder->orderBy('business_name', 'desc');

        } else {

          return $builder->orderBy('distance', 'asc');

        }
    }
}
