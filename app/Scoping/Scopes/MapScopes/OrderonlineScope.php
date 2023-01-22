<?php

namespace App\Scoping\Scopes\MapScopes;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class OrderonlineScope implements Scope
{
    public function apply(Builder $builder, $value)
    {
        return $builder->where('order_online', 1);
    }
}
