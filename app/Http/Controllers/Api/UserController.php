<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Application\NotificationResource;
use App\Http\Resources\Application\OrderResource;
use App\Http\Resources\Application\UserResource;
use App\Models\Notifications;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function userDetail($id)
    {
        $user = User::find($id);
        $success = new UserResource($user);
        return response()->json($success);
    }

    public function profileImage(Request $request)
    {
        $user = Auth::user();
        if ($request->hasFile('image')) {
            $image1 = $request->file('image');
            $name1 = time() . 'image1' . '.' . $image1->getClientOriginalExtension();
            $destinationPath = 'images';
            ini_set('memory_limit', '256M');
            $img = Image::make($image1);
            $img->resize(250, 250, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $name1);
            $user->profile = $destinationPath . '/' . $name1;
        }
        if ($user->update()) {
            return response()->json(['success' => 'Successfully Updated']);
        } else {
            return response()->json(['error' => 'Something Happend Wrong'], 400);
        }
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->dateofbirth = $request->dob;
        $user->delivery_address = $request->delivery_address;
        $user->about = $request->about;
        $user->update();
        return response()->json(['success' => 'Successfully Updated']);
    }

    public function notifications()
    {
        $notifications = Notifications::where('customer_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return response()->json(NotificationResource::collection($notifications));
    }

    public function orders(){
        $orders = Order::where('customer_id', Auth::user()->id)->whereNull('deal_id')->groupBy('tracking_number')->latest()->get();
        return response()->json(OrderResource::collection($orders));
    }
}
