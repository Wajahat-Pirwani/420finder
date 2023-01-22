<?php

namespace App\Scoping\Scopes\MapScopes;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class StoredeliveryScope implements Scope
{
    public function apply(Builder $builder, $value)
    {
        if(count(json_decode($value)) > 0)
        {
            return $builder->whereIn('business_type', json_decode($value));
        }
    }
}
