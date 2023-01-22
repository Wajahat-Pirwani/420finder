<?php

namespace App\Http\Resources\Application;

use App\Models\Favorite;
use App\Models\RetailerReview;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class AfterLoginBusinessResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = Auth::user();
        $checkFav = Favorite::where('customer_id', $user->id)->where('type_id', $this->id)->where('fav_type', $this->business_type)->first();
        $reviews = RetailerReview::where('customer_id', $user->id)->where('retailer_id', $this->id)->whereNull('product_id')->first();
        return [
            'id' => $this->id,
            'profile_picture' => (string)$this->profile_picture??"https://420finder.net/assets/img/logo01.png",
            'slug' => $this->slug??"retailer",
            'business_name' => $this->business_name??"",
            'business_type' => $this->business_type??"",
            'address_line_1' => $this->address_line_1??"",
            'address_line_2' => $this->address_line_2??"",
            'is_like' => $checkFav ? true: false,
            'is_reviewed' => $reviews ? true: false,
            'is_subscribed' => $this->checkSubscription(),
            'order_online' => $this->order_online == 1 ? true : false,
            'icon' => $this->icon??"",
            'custom_icon' => $this->custom_icon??"",
            'followers' => "222",
            'rating' => (double)$this->calculatedRating(),
            'reviews' => $this->review_count(),
            'state' => $this->state(),
            'open_status' => $this->checkOpenStatus(),
            'instagram' => $this->instagram??"",
            'twitter' => $this->twitter??"",
            'facebook' => $this->facebook??"",
            'website' => $this->website??"",
            'top_business' => $this->top_business == 1 ? true : false,
            'top_text' => $this->top_text??"",
            'phone_number' => $this->phone_number??"",
            'email' => $this->email??"",
            'latitude' => $this->latitude??"",
            'longitude' => $this->longitude??"",
            'monday_open' => date("h:i A", strtotime($this->monday_open))??"",
            'monday_close' => date("h:i A", strtotime($this->monday_close))??"",
            'tuesday_open' => date("h:i A", strtotime($this->tuesday_open))??"",
            'tuesday_close' => date("h:i A", strtotime($this->tuesday_close))??"",
            'wednesday_open' => date("h:i A", strtotime($this->wednesday_open))??"",
            'wednesday_close' => date("h:i A", strtotime($this->wednesday_close))??"",
            'thursday_open' => date("h:i A", strtotime($this->thursday_open))??"",
            'thursday_close' => date("h:i A", strtotime($this->thursday_close))??"",
            'friday_open' => date("h:i A", strtotime($this->friday_open))??"",
            'friday_close' => date("h:i A", strtotime($this->friday_close))??"",
            'saturday_open' => date("h:i A", strtotime($this->saturday_open))??"",
            'saturday_close' => date("h:i A", strtotime($this->saturday_close))??"",
            'sunday_open' => date("h:i A", strtotime($this->sunday_open))??"",
            'sunday_close' => date("h:i A", strtotime($this->sunday_close))??"",
            'current_time' => Carbon::parse(now())->timezone($delivery->timezone??"America/Los_Angeles")->format('H:i a')??"",
            'about' => $this->detail->about??"",
            'introduction' => $this->detail->introduction??"",
            'first_time_customer' => $this->detail->customers??"",
            'announcement' => $this->detail->announcement??"",
            'license' => $this->detail->license??"",
        ];
    }
}
