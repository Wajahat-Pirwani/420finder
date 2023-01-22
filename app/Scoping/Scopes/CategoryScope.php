<?php

namespace App\Scoping\Scopes;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class CategoryScope implements Scope
{
    public function apply(Builder $builder, $value)
    {

        if(count(json_decode($value)) > 0)
        {
            return $builder->whereIn('category_id', json_decode($value));
        }

        // return $builder->whereHas('categories', function ($builder) use ($value){

        //     $builder->where('slug', $value);

        // });

    }
}
