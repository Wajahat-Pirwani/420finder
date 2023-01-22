<?php

namespace App\Scoping\Scopes;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class RelevanceScope implements Scope
{
    public function apply(Builder $builder, $value)
    {

        if($value == 'relevance') {

            return $builder;

        } else if($value == 'recently-added') {

           return $builder->orderBy('created_at', 'desc');

        } else if($value == 'low-price') {

           return $builder->orderBy('price',  'asc');

        } else if($value == 'high-price') {

           return $builder->orderBy('price',  'desc');

        } else if($value == 'thc-low-to-high') {

            return $builder->whereNotNull('thc_percentage')->orderBy('thc_percentage', 'asc');

        } else if($value == 'thc-high-to-low') {

            return $builder->whereNotNull('thc_percentage')->orderBy('thc_percentage', 'desc');

        } else if($value == 'cbd-low-to-high') {

            return $builder->whereNotNull('cbd_percentage')->orderBy('cbd_percentage', 'asc');

        } else if($value == 'cbd-high-to-low') {

            return $builder->whereNotNull('cbd_percentage')->orderBy('cbd_percentage', 'desc');
        }
    }
}
