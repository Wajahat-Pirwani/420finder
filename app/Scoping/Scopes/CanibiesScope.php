<?php

namespace App\Scoping\Scopes;

use App\Scoping\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;

class CanibiesScope implements Scope
{
    public function apply(Builder $builder, $value)
    {

        if(count(json_decode($value)) > 0)
        {
            foreach(json_decode($value) as $val) {
                if($val == '1') {
                    return $builder->whereNotNull('thc_percentage');
                } else if($val == '2') {
                    return $builder->whereNotNull('cbd_percentage');
                }
            }
        }

    }
}
