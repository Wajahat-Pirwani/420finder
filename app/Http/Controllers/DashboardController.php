<?php
namespace App\Http\Controllers;
use App\Http\TrackHistory;
use App\Models\Business;
use App\Models\DealsClaimed;
use App\Models\Order;
use App\Models\RecentlyViewed;
use App\Models\RetailerReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Image;
class DashboardController extends Controller
{
    public function profile()
    {
        $user = User::where('id', session('customer_id'))
            ->select('name', 'profile')
            ->first();
        TrackHistory::track_history('Profile', "View Profile Dashboard");
        return view('profile.index')
            ->with('user', $user);
    }
    public function orderhistory()
    {
        $user = User::where('id', session('customer_id'))
            ->select('name', 'profile')
            ->first();
        $orders = Order::where('customer_id', session('customer_id'))
            ->groupBy('tracking_number')
            ->latest()->get();
        TrackHistory::track_history('Profile', "View Order History");
        return view('profile.orderhistory')
            ->with('user', $user)
            ->with('orders', $orders);
    }
    public function orderdetails($tracking_number)
    {
        $user = User::where('id', session('customer_id'))
            ->select('name', 'profile')
            ->first();
        $orders = Order::where('tracking_number', $tracking_number)
            ->where('customer_id', session('customer_id'))
            ->get();
        if (is_null($orders) || count($orders) < 1) {
            return redirect()->back();
        }
        $orderProducts = $orders->whereNull('deal_id');
        $orderDeals = $orders->whereNull('product_id');
        TrackHistory::track_history('Profile', "View Order Details");
        return view('profile.orderdetails')
            ->with('user', $user)
            ->with('orderProducts', $orderProducts)
            ->with('orderDeals', $orderDeals)
            ->with('tracking_number', $tracking_number);
    }
    public function recentlyviewed()
    {
        $user = User::where('id', session('customer_id'))
            ->select('name', 'profile')
            ->first();
        $recentlyvieweds = RecentlyViewed::where('customer_id', session('customer_id'))->get();
        TrackHistory::track_history('Profile', "View Recnently Viewed");
        return view('profile.recentlyviewed')
            ->with('user', $user)
            ->with('recentlyvieweds', $recentlyvieweds);
    }
    public function removerecentproduct($id)
    {
        $product = RecentlyViewed::find($id);
        $product->delete();
        TrackHistory::track_history('Profile', "Remove Recent Product");
        return redirect()->back()->with('error', 'Product Removed.');
    }
    public function dealsclaimed()
    {
        $user = User::where('id', session('customer_id'))
            ->select('name', 'profile')
            ->first();
        $deals = DealsClaimed::where('customer_id', session('customer_id'))->get();
        TrackHistory::track_history('Profile', "Deals Claim");
        return view('profile.dealsclaimed')
            ->with('user', $user)
            ->with('deals', $deals);
    }
    public function myreviews()
    {
        $user = User::where('id', session('customer_id'))
            ->select('name', 'profile')
            ->first();
        $reviews = RetailerReview::where('customer_id', session('customer_id'))->get();
        TrackHistory::track_history('Profile', "View My Reviews");
        return view('profile.myreviews')
            ->with('user', $user)
            ->with('reviews', $reviews);
    }
    public function removereview($id)
    {
        $review = RetailerReview::find($id);
        $retailerId = $review->retailer_id;
        if ($review->delete()) {
            $retailerReview = RetailerReview::where('retailer_id', $retailerId)->whereNull('product_id')->get();
            if (!is_null($retailerReview)) {
                Business::where('id', $retailerId)->update([
                    'reviews_count' => $retailerReview->count(),
                    'rating' => number_format($retailerReview->avg('rating'), 1)
                ]);
            }
            TrackHistory::track_history('Profile', "Remove Review");
            return redirect()->back()->with('info', 'Review removed successfully.');
        } else {
            return redirect()->back()->with('error', 'Sorry something went wrong.');
        }
    }
    public function accountsettings()
    {
        $user = User::where('id', session('customer_id'))->first();
        return view('profile.accountsettings')
            ->with('user', $user);
    }
    public function updatePassword(Request $request)
    {
        if ($request->password == $request->confirm) {
            $user = User::find(session('customer_id'));
            $user->password = Hash::make($request->password);
            $user->update();
            return redirect()->back()->with('info', "Password Updated Successfully");
        } else {
            return redirect()->back()->with('error', "Password Doesn't Match");
        }
    }
    public function changepassword()
    {
        $user = User::where('id', session('customer_id'))->first();
        TrackHistory::track_history('Profile', "View Password Changed");
        return view('profile.changepassword')
            ->with('user', $user);
    }
    public function savename(Request $request)
    {
        $user = User::find(session('customer_id'));
        $user->name = $request->name;
        if ($user->save()) {
            TrackHistory::track_history('Profile', "Update Name");
            $response = ['statuscode' => 200, 'message' => 'Name Saved.'];
            echo json_encode($response);
        } else {
            $response = ['statuscode' => 400, 'message' => 'Problem saving name.'];
            echo json_encode($response);
        }
    }
    public function savephonenumber(Request $request)
    {
        $user = User::find(session('customer_id'));
        $user->phone = $request->phone_number;
        if ($user->save()) {
            TrackHistory::track_history('Profile', "Update Phone Number");
            $response = ['statuscode' => 200, 'message' => 'Phone Number Saved.'];
            echo json_encode($response);
        } else {
            $response = ['statuscode' => 400, 'message' => 'Problem saving phone number.'];
            echo json_encode($response);
        }
    }
    public function savedateofbirth(Request $request)
    {
        $user = User::find(session('customer_id'));
        $user->dateofbirth = $request->dateofbirth;
        if ($user->save()) {
            TrackHistory::track_history('Profile', "Update Date of birth");
            $response = ['statuscode' => 200, 'message' => 'Date of birth Saved.'];
            echo json_encode($response);
        } else {
            $response = ['statuscode' => 400, 'message' => 'Problem saving date of birth.'];
            echo json_encode($response);
        }
    }
    public function savedeliveryaddress(Request $request)
    {
        $user = User::find(session('customer_id'));
        $user->delivery_address = $request->delivery_address;
        if ($user->save()) {
            TrackHistory::track_history('Profile', "Update Delivery Address");
            $response = ['statuscode' => 200, 'message' => 'Delivery Address Saved.'];
            echo json_encode($response);
        } else {
            $response = ['statuscode' => 400, 'message' => 'Problem saving delivery address.'];
            echo json_encode($response);
        }
    }
    public function saveabout(Request $request)
    {
        $user = User::find(session('customer_id'));
        $user->about = $request->about;
        if ($user->save()) {
            TrackHistory::track_history('Profile', "Update about Info");
            $response = ['statuscode' => 200, 'message' => 'About Description Saved.'];
            echo json_encode($response);
        } else {
            $response = ['statuscode' => 400, 'message' => 'Problem saving about description.'];
            echo json_encode($response);
        }
    }
    public function saveprofilepicture(Request $request)
    {
        $validated = $request->validate([
            'profile' => 'required|image'
        ]);
        $profile = User::find(session('customer_id'));
        // $imageName = time().'.'.request()->picture->getClientOriginalExtension();
        // request()->picture->move(public_path('images/seller/products'), $imageName);
        // $product->picture = asset("images/seller/products/" . $imageName);
        $oldImage = NULL;
        if ($request->hasFile('profile')) {
            $oldImage = $profile->profile;
        }
        $avatar = $request->file('profile');
        $filename = time() . '.' . $avatar->GetClientOriginalExtension();
        $avatar_img = Image::make($avatar);
        $avatar_img->resize(222, 147)->save(public_path('images/profile/' . $filename));
        $profile->profile = asset("images/profile/" . $filename);
        if ($profile->save()) {
            if (!is_null($oldImage)) {
                $exp = explode('/', $oldImage);
                $expImage = $exp[count($exp) - 1];
                if ($expImage != 'logo.png') {
                    if (File::exists(public_path('images/profile/' . $expImage))) {
                        File::delete(public_path('images/profile/' . $expImage));
                    }
                }
            }
            TrackHistory::track_history('Profile', "Update Profile Picture");
            return redirect()->back()->with('info', 'Profile Picture Updated.');
        } else {
            return redirect()->back()->with('error', 'Problem updating profile picture.');
        }
    }
}
