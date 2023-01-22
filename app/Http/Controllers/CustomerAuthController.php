<?php
namespace App\Http\Controllers;
use App\Http\TrackHistory;
use App\Jobs\WelcomeMailJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
class CustomerAuthController extends Controller
{
    public function checksignin(Request $request)
    {
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return back()->with('error', 'Please enter a valid email format.')->withInput();
        } else {
            $check = User::where('email', $request->email)->first();
            $count = User::where('email', $request->email)->count();
            if ($count > 0) {
                if (\Hash::check($request->password, $check->password)) {
                    $customer_id = $request->session()->put('customer_id', $check->id);
                    $customer_name = $request->session()->put('customer_name', $check->name);
                    $customer_email = $request->session()->put('customer_email', $check->email);
                    TrackHistory::track_history('Login',"Customer Logged In");
                    if (Session::has("prevUrlCustomer")) {
                        return redirect()->to(Session::get('prevUrlCustomer'));
                    } else {
                        return redirect()->route('profile')->with('info', "Login Successfully.");
                    }
                } else {
                    return back()->with('error', 'Email or password is invalid.')->withInput();
                }
            } else {
                return back()->with('error', 'Email or password is invalid.')->withInput();
            }
        }
    }
    public function accountsignup(Request $request)
    {
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with('error', 'Please Enter a Valid Email.')->withInput();
        } else if (trim($request->password) != trim($request->confirm_password)) {
            return redirect()->back()->with('error', 'Passwords does not match')->withInput();
        } else {
            $check = User::where('email', $request->email)->count();
            if ($check > 0) {
                return redirect()->back()->with('error', 'Email Already Registered.');
            } else {
                $user = new User;
                $user->name = $request->name;
                $user->profile = "https://420finder.net/assets/img/logo.png";
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                if ($user->save()) {
                    //   $business = new Business;
                    //   $business->business_name = $request->name;
                    //   $business->email = $request->email;
                    //   $business->business_type = 'Brand';
                    //   $business->license_type = 'Medical Cultivation';
                    //   $business->profile_picture = "https://420finder.net/assets/img/logo.png";
                    //   $business->password = Hash::make($request->password);
                    //   $business->status = 1;
                    //   $business->save();
                    $customer_id = $request->session()->put('customer_id', $user->id);
                    $customer_name = $request->session()->put('customer_name', $user->name);
                    dispatch(new WelcomeMailJob($user->email,$user));
                    TrackHistory::track_history('Signup',"Customer Signup");
                    return redirect()->route('profile');
                } else {
                    return redirect()->back()->with('error', 'Something Went Wrong.');
                }
            }
        }
    }
    public function logout()
    {
        TrackHistory::track_history('Logout',"Customer Logged Out");
        session()->forget('customer_name');
        session()->forget('customer_id');
        return redirect()->route('signin');
    }
}
