<?php

namespace App\Http\Controllers\Api;

use App\Models\Business;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MapResource;

class DetailsController extends Controller
{
    public function index() {

        $requestData = request()->all();

        $deliveryId = $requestData['delivery_id'];

        $business = Business::where('id', $deliveryId)->first();

        return new MapResource($business);
        
    }
}
