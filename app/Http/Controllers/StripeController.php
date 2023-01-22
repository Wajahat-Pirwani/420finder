<?php
namespace App\Http\Controllers;
use App\Mail\OrderPlaced;
use App\Models\Business;
use App\Models\DealsClaimed;
use App\Models\DeliveryCart;
use App\Models\DeliveryProducts;
use App\Models\DispenseryProduct;
use App\Models\Order;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Session;
class StripeController extends Controller
{
    public function checkout()
    {
        return view('checkout');
    }
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        $this->addOrder($request);
        return redirect()->route('orderhistory')->with("info", "Your Order has been Received Successfully. Please Check Your Email.");
    }
    private function addOrder($request)
    {
        $validated = $request->validate([
            'nameonorder' => 'required',
            'phone_number' => 'required',
            'nameonid' => 'required',
            'id_type' => 'required',
            'id_number' => 'required',
            'delivery_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required'
        ]);
        // ======================== DELIVERY PRODUCTS ======================
        $checkDelivery = DeliveryCart::where('customer_id', session('customer_id'))->get();
        $tracking_number = 0;
        $customerDetail = User::where('id', session('customer_id'))->first();
        $products = [];
        $isDeliveryProduct = false;
        if ($checkDelivery->count() > 0) {
            // $productId = $checkDelivery->pluck('product_id')->first();
            // $isDelivery = DeliveryProducts::where('id', $productId)->count();
            $businessId = $checkDelivery->pluck('business_id')->first();
            $isDelivery = Business::where('id', $businessId)->where('business_type',
                'delivery')->count();
            if ($isDelivery) {
                $products = DeliveryCart::where('customer_id', session('customer_id'))
                    ->join('delivery_products', 'delivery_products.id', '=', 'delivery_carts.product_id')
                    ->get();
                $isDeliveryProduct = true;
            } else {
                $products = DeliveryCart::where('customer_id', session('customer_id'))
                    ->join('dispensery_products', 'dispensery_products.id', '=', 'delivery_carts.product_id')
                    ->get();
            }
            // $countorders = Order::count();
            $tracking_number = (string)Str::random(6);
            // $retailer_ids = [];
            $retailerId = "";
            foreach ($checkDelivery as $key => $delivery) {
                $product = "";
                if ($isDeliveryProduct) {
                    $product = DeliveryProducts::where('id', $delivery->product_id)->first();
                } else {
                    $product = DispenseryProduct::where('id', $delivery->product_id)->first();
                }
                // $ids = array_push($retailer_ids, $product->delivery_id);
                // Saving in Orders Table
                $order = new Order;
                $order->tracking_number = $tracking_number;
                if ($isDeliveryProduct) {
                    $retailerId = $product->delivery_id;
                    $order->retailer_id = $product->delivery_id;
                } else {
                    $retailerId = $product->dispensery_id;
                    $order->retailer_id = $product->dispensery_id;
                }
                $order->customer_id = session('customer_id');
                $order->product_id = $delivery->product_id;
                $order->price = $product->price * $delivery->qty;
                // $order->customer_address = $customerDetail->delivery_address;
                $order->customer_address = $request['delivery_address'];
                // $order->qty = $delivery->product_id;
                $order->qty = $delivery->qty;
                $order->order_date = date('Y-m-d');
                $order->customer_name = $customerDetail->name;
                $order->customer_email = $customerDetail->email;
                // $order->customer_phone = $customerDetail->phone;
                $order->customer_phone = $request['phone_number'];
                $order->nameonorder = $request['nameonorder'];
                $order->delivery_address = $request['delivery_address'];
                $order->nameonid = $request['nameonid'];
                $order->id_type = $request['id_type'];
                $order->id_number = $request['id_number'];
                $order->additional_notes = $request['additional_notes'];
                $order->city = $validated['city'];
                $order->state = $validated['state'];
                $order->zip_code = $validated['zip_code'];
                $order->read = 1;
                $order->save();
            }
        }
        // ======================= DEALS CLAIMED ========================
        $dealsClaimedExist = DealsClaimed::where('customer_id', session('customer_id'))->get();
        $deals = [];
        if ($dealsClaimedExist->count() > 0) {
            $dealsClaimed = DealsClaimed::where('customer_id', session('customer_id'))->join('deals', 'deals.id', '=', 'deals_claimeds.deal_id')
                ->get();
            $deals = $dealsClaimed;
            if ($checkDelivery->count() < 1) {
                // $countorders = DealPurchase::count();
                $retailerId = $dealsClaimed[0]['retailer_id'];
                $tracking_number = (string)Str::random(6);
            }
            // $totalPrice = $dealsClaimed->sum('deal_price');
            foreach ($dealsClaimed as $dc) {
                Order::create([
                    'customer_id' => session('customer_id'),
                    'retailer_id' => $dc->retailer_id,
                    'deal_id' => $dc->id,
                    'tracking_number' => $tracking_number,
                    'price' => $dc->deal_price,
                    'qty' => 1,
                    'status' => 'Submitted',
                    'order_date' => date('Y-m-d'),
                    'customer_name' => $customerDetail->name,
                    'customer_email' => $customerDetail->email,
                    'customer_address' => $validated['delivery_address'],
                    'nameonorder' => $validated['nameonorder'],
                    'customer_phone' => $validated['phone_number'],
                    'nameonid' => $validated['nameonid'],
                    'id_type' => $validated['id_type'],
                    'id_number' => $validated['id_number'],
                    'delivery_address' => $validated['delivery_address'],
                    'city' => $validated['city'],
                    'state' => $validated['state'],
                    'zip_code' => $validated['zip_code'],
                    'additional_notes' => $request['additional_notes'],
                    'read' => 1
                ]);
            }
        }
        try {
            $customer = [
                'customer' => $customerDetail
            ];
            $retailerDetail = Business::find($retailerId);
            $order = Order::where('tracking_number', $tracking_number)->first();
            Mail::to($customerDetail->email)->send(new OrderPlaced($customer, $products, $retailerDetail, $tracking_number, $order, $deals));
            $retailer = [
                'business' => $retailerDetail,
            ];
            Mail::to($retailerDetail->email)->send(new OrderPlaced($retailer, $products, $customerDetail, $tracking_number, $order, $deals));
            $admin = [
                'admin' => '',
                'retailerDetail' => $retailerDetail
            ];
            Mail::to('support@420finder.net')->send(new OrderPlaced($admin, collect($products), $customerDetail, $tracking_number, $order, $deals));
            if ($checkDelivery->count() > 0) {
                $emptyCart = DeliveryCart::where('customer_id', session('customer_id'))->delete();
            }
            if ($dealsClaimedExist->count() > 0) {
                $deleted = DealsClaimed::where("customer_id", session('customer_id'))->delete();
            }
        } catch (Exception $e) {
            if ($checkDelivery->count() > 0) {
                Order::where('tracking_number', $tracking_number)->delete();
            }
            // if($dealsClaimedExist->count() > 0) {
            //     DealPurchase::where('tracking_number', $tracking_number)->delete();
            // }
            dd($tracking_number);
            return redirect()->back();
            // abort(501);
        }
    }
    public function updateCart(Request $request)
    {
        $validated = $request->validate([
            'products.*' => 'required'
        ]);
        if (is_array($request->products)) {
            if (count($request->products) > 0) {
                foreach ($request->products as $product) {
                    $qty = 1;
                    if ($product['qty'] > 1) {
                        $qty = $product['qty'];
                    }
                    DeliveryCart::where('customer_id', session('customer_id'))
                        ->where('product_id', $product['product_id'])
                        ->update([
                            'qty' => $qty
                        ]);
                }
                return redirect()->back()->with('update-cart', 'Cart Updated!');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }
    public function stripeApproval()
    {
        if (session()->has('paymentPlatformId')) {
            $paymentPlatformId = session()->get('paymentPlatformId');
            if ($paymentPlatformId == 1) {
                $stripeService = resolve(StripeService::class);
                return $stripeService->handleApproval();
            } else {
                $paypalService = resolve(PayPalService::class);
                return $paypalService->handleApproval();
            }
        }
        return redirect()
            ->route('cart')
            ->with('error', 'We cannot retrieve your payment platform. Try again, please.');
    }
    public function paypalCancelled()
    {
        return redirect()
            ->route('cart')
            ->with('error', 'You cancelled the payment.');
    }
    private function calcTotalProductsPrice()
    {
        $totalprice = 0;
        $checkDelivery = DeliveryCart::where('customer_id', session('customer_id'))->get();
        foreach ($checkDelivery as $key => $value) {
            $product = DeliveryProducts::where('id', $value->product_id)->first();
            $totalprice = $totalprice + $product->price;
        }
        return $totalprice;
    }
}
