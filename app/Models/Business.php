<?php

namespace App\Models;

use App\Models\Traits\CanBeScoped;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Business extends Model
{
    use HasFactory, CanBeScoped;

    public function brands()
    {

        return $this->hasMany('App\Models\Brand');
    }

    public function detail()
    {
        return $this->hasOne(Detail::class);
    }

    public function deals()
    {

        return $this->hasMany(Deal::class, 'retailer_id');

    }

    public function deliveryProducts()
    {
        return $this->hasMany(DeliveryProducts::class, 'id');
    }

    public function dispensaryProducts()
    {
        return $this->hasMany(DispenseryProduct::class, 'id');
    }

    public function checkOpenStatus()
    {
        $date = Carbon::parse(now())->timezone($this->timezone ?? "America/Los_Angeles");
        $checkTime = Carbon::parse(now())->timezone($this->timezone ?? "America/Los_Angeles")->format('H:i');
        switch ($date->format('D')) {
            case "Mon":
                if ($this->monday_open <= $checkTime && $this->monday_close >= $checkTime && $this->monday_open != null && $this->monday_close != null) {
                    return "OPEN NOW" . " Until " . date("h:i a", strtotime($this->monday_close));
                } else {
                    return "CLOSED";
                }
                break;
            case "Tue":
                if ($this->tuesday_open <= $checkTime && $this->tuesday_close >= $checkTime && $this->tuesday_open != null && $this->tuesday_close != null) {
                    return "OPEN NOW" . " Until " . date("h:i a", strtotime($this->tuesday_close));
                } else {
                    return "CLOSED";
                }
                break;
            case "Wed":
                if ($this->wednesday_open <= $checkTime && $this->wednesday_close >= $checkTime && $this->wednesday_open != null && $this->wednesday_close != null) {
                    return "OPEN NOW" . " Until " . date("h:i a", strtotime($this->wednesday_close));
                } else {
                    return "CLOSED";
                }
                break;
            case "Thu":
                if ($this->thursday_open <= $checkTime && $this->thursday_close >= $checkTime && $this->thursday_open != null && $this->thursday_close != null) {
                    return "OPEN NOW" . " Until " . date("h:i a", strtotime($this->thursday_close));
                } else {
                    return "CLOSED";
                }
                break;
            case "Fri":
                if ($this->friday_open <= $checkTime && $this->friday_close >= $checkTime && $this->friday_open != null && $this->friday_close != null) {
                    return "OPEN NOW" . " Until " . date("h:i a", strtotime($this->friday_close));
                } else {
                    return "CLOSED";
                }
                break;
            case "Sat":
                if ($this->saturday_open <= $checkTime && $this->saturday_close >= $checkTime && $this->saturday_open != null && $this->saturday_close != null) {
                    return "OPEN NOW" . " Until " . date("h:i a", strtotime($this->saturday_close));
                } else {
                    return "CLOSED";
                }
                break;
            case "Sun":
                if ($this->sunday_open <= $checkTime && $this->sunday_close >= $checkTime && $this->sunday_open != null && $this->sunday_close != null) {
                    return "OPEN NOW" . " Until " . date("h:i a", strtotime($this->sunday_close));
                } else {
                    return "CLOSED";
                }
                break;
        }
    }

    public function state()
    {
        $state = \Illuminate\Support\Facades\DB::table('states')->where('id', '=', $this->state_province)->first();
        return $state->name ?? "State Name";
    }

    public function calculatedRating()
    {
        $reviews = $this->reviews();
        if ($reviews->count() > 0) {
            $retailer_star = $reviews->sum('rating');
            $buisness_star = $this->rating * $this->reviews_count;
            $total_review = $reviews->count() + $this->reviews_count;
            $totalratings = ($retailer_star + $buisness_star) / $total_review;
            return number_format($totalratings, 1);
        } else {
            $totalratings = 0;
            return $totalratings;
        }
    }

    //    counting total ratings from both talbles

    public function reviews()
    {
        return $this->hasMany(RetailerReview::class, 'retailer_id')->whereNull('product_id')->whereNotNull('rating');

    }

//    counting total reviews from both talbles

    public function review_count()
    {
        $reviews = $this->reviews();
        $total_reviews = $reviews->count() + $this->reviews_count;
        return $total_reviews;
    }

//    check subscription

    public function checkSubscription()
    {
        $date = DB::table('subscription_details')->orderBy('id', 'DESC')->where('retailer_id', '=', $this->id)->first();
        if ($date){
            $currentDate = date('Y-m-d');
            $currentDate = date('Y-m-d', strtotime($currentDate));
            $startDate = date('Y-m-d', strtotime($date->starting_date ?? '12-2-2021'));
            $endDate = date('Y-m-d', strtotime($date->ending_date ?? '12-2-2021'));
            if (($currentDate >= $startDate) && ($currentDate <= $endDate)) {
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }
}
