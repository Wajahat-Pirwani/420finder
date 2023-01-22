<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Application\AfterLoginBusinessResource;
use App\Models\Business;

class AfterLoginApplicationController extends Controller
{
    public function top10($latitude, $longitude)
    {
        $topBusinesses = Business::selectRaw("businesses.* ,
            ( 6371000 * acos( cos( radians(?) ) *
            cos( radians( latitude ) )
            * cos( radians( longitude ) - radians(?)
            ) + sin( radians(?) ) *
            sin( radians( latitude ) ) )
            ) AS distance", [$latitude, $longitude, $latitude])
            ->orderBy('order', 'ASC')
            ->having("distance", "<", 17000)
            ->orderBy('distance', 'asc')
            ->where('top_business', 1)
            ->where('approve', 1)
            ->limit(10)->get();
        return response()->json(AfterLoginBusinessResource::collection($topBusinesses));
    }
}
