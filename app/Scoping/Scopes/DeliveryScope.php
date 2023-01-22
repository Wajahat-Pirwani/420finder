<?php

namespace App\Scoping\Scopes;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class DeliveryScope implements Scope
{
    public function apply(Builder $builder, $value)
    {

        return $builder->where('delivery_id', $value);
    }
}
