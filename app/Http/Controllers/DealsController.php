<?php
namespace App\Http\Controllers;
use App\Mail\DealPlaced;
use App\Models\Business;
use App\Models\Deal;
use App\Models\DealProduct;
use App\Models\DealPurchase;
use App\Models\DealsClaimed;
use App\Models\DeliveryCart;
use App\Models\User;
use Illuminate\Http\Request;
class DealsController extends Controller
{
    public function dealsingle($id)
    {
        $deal = Deal::where('id', $id)->first();
        if (is_null($deal)) {
            return redirect()->back();
        }
        $business = Business::where('id', $deal->retailer_id)->pluck('business_type')->first();
        $products = "";
        if ($business == 'Delivery') {
            $products = DealProduct::where('deal_id', $id)
                ->join('delivery_products', 'delivery_products.id', '=', 'deal_products.product_id')
                ->with('categories')
                ->with('retailer')
                ->get();
        } else {
            $products = DealProduct::where('deal_id', $id)
                ->join('dispensery_products', 'dispensery_products.id', '=', 'deal_products.product_id')
                ->with('categories')
                ->with('disRetailer')
                ->get();
        }
        return view('dealsingle')
            ->with('deal', $deal)
            ->with('dealBusinessType', $business)
            ->with('products', $products);
    }
    public function claimdeal(Request $request)
    {
        $customer_id = session('customer_id');
        $deal_id = $request->deal_id;
        if ($request->empty == 'true') {
            $deliveryCart = DeliveryCart::where('customer_id', session('customer_id'))->delete();
            $dealsCart = DealsClaimed::where('customer_id', session('customer_id'))->delete();
        }
        $deal = Deal::where('id', $deal_id)->first();
        if ($request->empty == 'false') {
            // $products = DeliveryProducts::where('delivery_id', $deal->retailer_id)->pluck('id')->toArray();
            $deliveryCartProducts = DeliveryCart::where('customer_id', session('customer_id'))->where('business_id', '!=', $deal->retailer_id)->count();
            $dealsClaimed = Deal::where('retailer_id', $deal->retailer_id)->pluck('id')->toArray();
            $dealsClaimedCount = DealsClaimed::where('customer_id', $customer_id)->whereNotIn('deal_id', $dealsClaimed)->count();
            if ($deliveryCartProducts > 0 || $dealsClaimedCount > 0) {
                echo json_encode(
                    [
                        'data' =>
                            [
                                'message' => 'You currently have items in your cart from another retailer. You may only add items from one retailer at a time. Would you like to finish your previous order, or start a new cart?.',
                                'status' => 500
                            ]
                    ]
                );
                return;
            }
        }
        $check = DealsClaimed::where('customer_id', $customer_id)->where('deal_id', $deal_id)->get();
        if ($check->count() > 0) {
            echo json_encode(
                [
                    'data' =>
                        [
                            'statuscode' => 400,
                            'message' => "Deal Already Claimed."
                        ]
                ]
            );
        } else {
            $claim = new DealsClaimed;
            $claim->customer_id = $customer_id;
            $claim->deal_id = $deal_id;
            if ($claim->save()) {
                // $customer = User::where('id', session('customer_id'))->first();
                // $business = Business::where('id', $deal->retailer_id)->first();
                // $customerDetail = [
                //     'customer' => $customer
                // ];
                // $businessDetail = [
                //     'business' => $business
                // ];
                //    Mail::to($customer->email)->send(new DealPlaced($customerDetail));
                //    Mail::to($business->email)->send(new DealPlaced($businessDetail));
                echo json_encode(
                    [
                        'data' =>
                            [
                                'statuscode' => 200,
                                'message' => "Deal Claimed.",
                                'redirectUrl' => route('cart')
                            ]
                    ]
                );
            } else {
                echo json_encode(
                    [
                        'data' =>
                            [
                                'statuscode' => 400,
                                'message' => "Something went wrong."
                            ]
                    ]
                );
            }
        }
    }
    // DELETE DEALS CLAIMED
    public function deleteDealsClaimed($id)
    {
        $deleted = DealsClaimed::where('deal_id', $id)->where('customer_id', session('customer_id'))->delete();
        if ($deleted) {
            return back()->with('success', 'Deal Removed');
        } else {
            return back()->with('error', 'Something went wrong');
        }
    }
    // DEAL PURCHASE
    public function dealPurchased(Request $request)
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
            'zip_code' => 'required',
            'additional_notes' => 'required',
        ]);
        $dealsClaimed = DealsClaimed::where('customer_id', session('customer_id'))->join('deals', 'deals.id', '=', 'deals_claimeds.deal_id')
            ->get();
        $totalPrice = $dealsClaimed->sum('deal_price');
        foreach ($dealsClaimed as $dc) {
            DealPurchase::create([
                'customer_id' => session('customer_id'),
                'deal_id' => $dc->id,
                'total_price' => $totalPrice,
                'qty' => 1,
                'status' => 'Submitted',
                'name_on_order' => $validated['nameonorder'],
                'phone_number' => $validated['phone_number'],
                'name_on_id' => $validated['nameonid'],
                'id_type' => $validated['id_type'],
                'id_number' => $validated['id_number'],
                'delivery_address' => $validated['delivery_address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'zip_code' => $validated['zip_code'],
                'note' => $validated['additional_notes']
            ]);
        }
        $deleted = DealsClaimed::where("customer_id", session('customer_id'))->delete();
        if ($deleted) {
            return redirect()->route("dealPurchasedList");
        } else {
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
    public function dealPurchasedList()
    {
        $dealsPurchased = DealPurchase::where("customer_id", session('customer_id'))->join("deals", 'deals.id', '=', 'deal_purchases.deal_id')
            ->select('deals.*', 'deal_purchases.*')
            ->get();
        $user = User::where('id', session('customer_id'))->first();
        return view('profile.dealspurchased', [
            'dealsPurchased' => $dealsPurchased,
            'user' => $user
        ]);
    }
}
