<?php

namespace App\Scoping\Scopes;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class BrandlistScope implements Scope
{
    public function apply(Builder $builder, $value)
    {

        if(count(json_decode($value)) > 0)
        {
            return $builder->whereIn('brand_id', json_decode($value));
        }

    }
}
