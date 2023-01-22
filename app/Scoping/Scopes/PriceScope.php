<?php

namespace App\Scoping\Scopes;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class PriceScope implements Scope
{
    public function apply(Builder $builder, $value)
    {

        if($value == 'any') {

            return $builder;

        } else if($value == '24') {

           return $builder->where('price', '<', 25);

        } else if($value == '26') {

           return $builder->whereBetween('price',  [25, 50]);

        } else if($value == '51') {

           return $builder->whereBetween('price',  [50, 100]);

        } else if($value == '101') {

            return $builder->whereBetween('price', [100, 200]);
        }
    }
}
