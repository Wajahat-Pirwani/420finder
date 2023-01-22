<?php

namespace App\Scoping\Scopes\MapScopes;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class BestofScope implements Scope
{
    public function apply(Builder $builder, $value)
    {
        return $builder->where('top_business', 1)->orderBy('order', 'asc');
    }
}
