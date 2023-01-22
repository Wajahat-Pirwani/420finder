<?php

namespace App\Scoping\Scopes\MapScopes;

use App\Models\DeliveryProducts;
use App\Scoping\Contracts\Scope;
use App\Models\DispenseryProduct;
use Illuminate\Database\Eloquent\Builder;

class MapCategoryScope implements Scope
{
    public function apply(Builder $builder, $value)
    {

        if(count(json_decode($value)) > 0)
        {

            $deliveryProducts = DeliveryProducts::whereIn('category_id', json_decode($value))->pluck('delivery_id');

            $dispensaryProducts = DispenseryProduct::whereIn('category_id',json_decode($value))->pluck('dispensery_id');


            $businessIds = array_unique($deliveryProducts->merge($dispensaryProducts)->toArray());

            return $builder->whereIn('id', $businessIds);

        }

    }
}

