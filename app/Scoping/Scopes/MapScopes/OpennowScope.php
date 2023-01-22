<?php

namespace App\Scoping\Scopes\MapScopes;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class OpennowScope implements Scope
{
    public function apply(Builder $builder, $value)
    {
        $time = date('h:i');

        return $builder->where([
            ['opening_time', '<=', $time],
            ['closing_time', '>=', $time]
        ]);
    }
}
