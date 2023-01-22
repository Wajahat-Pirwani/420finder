<?php

namespace App\Scoping\Scopes;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class BrandScope implements Scope
{
    public function apply(Builder $builder, $value)
    {
        if($value == 1) {
            return $builder->where('brand_product', $value);
        } else {
            return $builder->whereIn('brand_product', [0, 1]);
        }

    }
}
