<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    protected $detail;
    protected $deliveryProducts;
    protected $customerDetail;
    protected $orderId;
    protected $orderInfo;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($detail, $deliveryProducts, $customerDetail, $orderId, $orderInfo)
    {
        $this->detail = $detail;
        $this->deliveryProducts = $deliveryProducts;
        $this->customerDetail = $customerDetail;
        $this->orderId = $orderId;
        $this->orderInfo = $orderInfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $orderDeals = Order::where('tracking_number', $this->orderId)
            ->where('customer_id', session('customer_id'))
            ->whereNull('product_id')
            ->join('deals', 'deals.id', '=', 'orders.deal_id')
            ->get();

        if(array_key_exists("customer", $this->detail)) {

            return $this->from('support@420finder.net', '420 Finder')
            ->subject('Order Confirmation Summary #' . $this->orderId)
            ->view('emails.deals.customer')->with('details', $this->detail)->with('products', $this->deliveryProducts)
            ->with('orderDeals', $orderDeals)
            ->with('retailerDetails', $this->customerDetail)
            ->with('orderInfo', $this->orderInfo)
            ->with('logo', asset('assets/img/logo.png'));

        } else if(array_key_exists("business", $this->detail)) {

            return $this->from('support@420finder.net', '420 Finder')
            ->subject('Order Confirmation Summary #' . $this->orderId)
            ->view('emails.deals.business')->with('details', $this->detail)->with('products', $this->deliveryProducts)
            ->with('orderDeals', $orderDeals)
            ->with('customerDetail', $this->customerDetail)
            ->with('orderInfo', $this->orderInfo)
            ->with('logo', asset('assets/img/logo.png'))
            ;

        } else if(array_key_exists("admin", $this->detail)) {

            return $this->from('support@420finder.net', '420 Finder')
            ->subject('Order Confirmation Summary #' . $this->orderId)
            ->view('emails.deals.admin')->with('details', $this->detail)->with('products', $this->deliveryProducts)
            ->with('orderDeals', $orderDeals)
            ->with('retailerDetails', $this->detail['retailerDetail'])
            ->with('customerDetail', $this->customerDetail)
            ->with('orderInfo', $this->orderInfo)
            ->with('logo', asset('assets/img/logo.png'))
            ;

        }

    }
}
