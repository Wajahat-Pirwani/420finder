<?php
namespace App\Http\Controllers;
use App\Models\Brand;
use App\Models\BrandFeed;
use App\Models\BrandProduct;
use App\Models\BrandProductReview;
use App\Models\Business;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class BusinessController extends Controller
{
    public function businesssignin()
    {
        return view('businesssignin');
    }
    public function authenticate(Request $request)
    {
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return back()->with('error', 'Please enter a valid email format.')->withInput();
        } else {
            $check = Business::where('email', $request->email)->where('business_type', 'brand')->first();
            $count = Business::where('email', $request->email)->where('business_type', 'brand')->count();
            if ($count > 0) {
                if ($check['status'] == 0) {
                    return back()->with('error', 'Your account is under review by our account mangement team. Please have patience until you are approched by our account management team.')->withInput();
                } elseif ($check['status'] == 1) {
                    if (\Hash::check($request->password, $check->password)) {
                        $business_id = $request->session()->put('business_id', $check->id);
                        $business_fn = $request->session()->put('business_fn', $check->first_name);
                        $business_ln = $request->session()->put('business_ln', $check->last_name);
                        $business_email = $request->session()->put('business_email', $check->email);
                        if (Session::has("prevUrl")) {
                            return redirect()->to(Session::get('prevUrl'));
                        } else {
                            return redirect()->route('businessprofile')->with('info', "Login Successfully.");
                        }
                    } else {
                        return back()->with('error', 'Email or password is invalid.')->withInput();
                    }
                } elseif ($check['status'] == 2) {
                    return back()->with('error', 'Your account is blocked due to some reason. For further information please contact us.')->withInput();
                }
            } else {
                return back()->with('error', 'Email or password is invalid.')->withInput();
            }
        }
    }
    public function businessprofile()
    {
        $totalbrands = Brand::where('business_id', session('business_id'))->count();
        $publishedbrands = Brand::where('business_id', session('business_id'))->where('status', 1)->count();
        $unpublishedbrands = Brand::where('business_id', session('business_id'))->where('status', 0)->count();
        $totalfeeds = BrandFeed::where('business_id', session('business_id'))->count();
        $brandids = Brand::where('business_id', session('business_id'))->select('id')->get();
        $totalproducts = 0;
        foreach ($brandids as $pbsingle) {
            $brandproducts = BrandProduct::where('brand_id', $pbsingle->id)->count();
            $totalproducts = $totalproducts + $brandproducts;
        }
        $totalproductreviews = 0;
        foreach ($brandids as $bsingle) {
            $brandreviews = BrandProductReview::where('brand_id', $bsingle->id)->count();
            $totalproductreviews = $totalproductreviews + $brandreviews;
        }
        $products = [];
        for ($month = 1; $month <= date('m'); $month++) {
            $products[$month] = 0;
        }
        foreach ($brandids as $brand) {
            for ($month = 1; $month <= date('m'); $month++) {
                $date = Carbon::create(date('Y'), $month);
                $date_end = $date->copy()->endOfMonth();
                $product = BrandProduct::where('brand_id', $brand->id)
                    ->where('created_at', '>=', $date)
                    ->where('created_at', '<=', $date_end)
                    ->count();
                $currentProduct = $products[$month];
                $currentProduct += (int)$product;
                $products[$month] = $currentProduct;
            }
        }
        $chart = (new LarapexChart)->lineChart()
            ->setTitle('Products')
            ->setSubtitle('Total products added this year')
            ->addData('Products', array_values($products))
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']);
        $pieChart = (new LarapexChart)->pieChart()
            ->setTitle('Statistics')
            ->setSubtitle('Year 2022')
            ->addData([$totalbrands, $totalproducts, $totalfeeds])
            ->setLabels(['Brands', 'Products', 'Feeds']);
        return view('business.index')
            ->with('totalbrands', $totalbrands)
            ->with('publishedbrands', $publishedbrands)
            ->with('unpublishedbrands', $unpublishedbrands)
            ->with('totalfeeds', $totalfeeds)
            ->with('totalproducts', $totalproducts)
            ->with('chart', $chart)
            ->with('pieChart', $pieChart)
            ->with('totalproductreviews', $totalproductreviews);
    }
    public function businessaccountsettings()
    {
        $business = Business::where('id', session('business_id'))->first();
        return view('business.accountsettings')
            ->with('business', $business);
    }
    public function updatefirstname(Request $request)
    {
        $business = Business::find(session('business_id'));
        $business->first_name = $request->first_name;
        if ($business->save()) {
            $response = ['statuscode' => 200, 'message' => 'First Name Updated.'];
            echo json_encode($response);
        } else {
            $response = ['statuscode' => 400, 'message' => 'Problem saving first name.'];
            echo json_encode($response);
        }
    }
    public function updatelastname(Request $request)
    {
        $business = Business::find(session('business_id'));
        $business->last_name = $request->last_name;
        if ($business->save()) {
            $response = ['statuscode' => 200, 'message' => 'Last Name Updated.'];
            echo json_encode($response);
        } else {
            $response = ['statuscode' => 400, 'message' => 'Problem saving last name.'];
            echo json_encode($response);
        }
    }
    public function updatephonenumber(Request $request)
    {
        $business = Business::find(session('business_id'));
        $business->phone_number = $request->phone_number;
        if ($business->save()) {
            $response = ['statuscode' => 200, 'message' => 'Phone Number Updated.'];
            echo json_encode($response);
        } else {
            $response = ['statuscode' => 400, 'message' => 'Problem saving phone number.'];
            echo json_encode($response);
        }
    }
    public function updatebusinessname(Request $request)
    {
        $business = Business::find(session('business_id'));
        $business->business_name = $request->business_name;
        if ($business->save()) {
            $response = ['statuscode' => 200, 'message' => 'Business Name Updated.'];
            echo json_encode($response);
        } else {
            $response = ['statuscode' => 400, 'message' => 'Problem saving business name.'];
            echo json_encode($response);
        }
    }
    public function updateaddresslineone(Request $request)
    {
        $business = Business::find(session('business_id'));
        $business->address_line_1 = $request->address_line_1;
        if ($business->save()) {
            $response = ['statuscode' => 200, 'message' => 'Address Line 1 Updated.'];
            echo json_encode($response);
        } else {
            $response = ['statuscode' => 400, 'message' => 'Problem saving address line 1.'];
            echo json_encode($response);
        }
    }
    public function updateaddresslinetwo(Request $request)
    {
        $business = Business::find(session('business_id'));
        $business->address_line_2 = $request->address_line_2;
        if ($business->save()) {
            $response = ['statuscode' => 200, 'message' => 'Address Line 2 Updated.'];
            echo json_encode($response);
        } else {
            $response = ['statuscode' => 400, 'message' => 'Problem saving address line 2.'];
            echo json_encode($response);
        }
    }
    public function updatewebsite(Request $request)
    {
        $business = Business::find(session('business_id'));
        $business->website = $request->website;
        if ($business->save()) {
            $response = ['statuscode' => 200, 'message' => 'Website URL Updated.'];
            echo json_encode($response);
        } else {
            $response = ['statuscode' => 400, 'message' => 'Problem saving website url.'];
            echo json_encode($response);
        }
    }
    public function businesslogout()
    {
        session()->forget('business_id');
        session()->forget('business_fn');
        session()->forget('business_ln');
        return redirect()->route('businesssignin');
    }
}
