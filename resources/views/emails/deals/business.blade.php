<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Email</title>
</head>

<body>

    <div>
        <div style="width: 100%;
        max-width: 470px;
        text-align: left;
        border-radius: 8px;
        margin: 32px auto 0;
        padding: 0 20px;
        border: 1px solid #c9cccf;">
            <div>
                <h3 style="color: #202223;
                font-weight: 600;
                font-size: 16px;">Order Summary</h3>
            </div>

            <!-- Products Wrapper -->
            <div>
                <?php $total = 0?>
                @if(count($products) > 0)
                @foreach ($products as $product)
                <?php
                $productTotal = $product->price * $product->qty;
                $total = $total + $productTotal; ?>
                <div style="display: flex; justify-content: space-between;">
                    <div style="display: flex;">
                        <img src="{{ $product->image }}" alt="Product Image" style="height: 50px;
                        line-height: 0;
                        outline: none;
                        text-decoration: none;
                        vertical-align: top;
                        width: 50px;
                        margin-right: 16px;
                        border-radius: 4px;
                        border: 1px solid #c9cccf;">
                        <div>
                            <span style="display: block;">{{ $product->name }}</span>
                            <span>$ {{ $product->price }} x {{ $product->qty }}</span>
                        </div>
                    </div>
                    <div>
                        <span>$ {{ $productTotal }}</span>
                    </div>
                </div>
                @endforeach
                @endif

                @if(!is_null($orderDeals) && count($orderDeals) > 0)
                @foreach ($orderDeals as $deal)
                <?php $total = $total + $deal->deal_price; ?>
                <div style="display: flex; justify-content: space-between;">
                    <div style="display: flex;">
                        <img src="{{ json_decode($deal->picture)[0] }}" alt="Product Image" style="height: 50px;
                        line-height: 0;
                        outline: none;
                        text-decoration: none;
                        vertical-align: top;
                        width: 50px;
                        margin-right: 16px;
                        border-radius: 4px;
                        border: 1px solid #c9cccf;">
                        <div>
                            <span style="display: block;">{{ $deal->title }}</span>
                            <span>$ {{ $deal->deal_price }} x {{ $deal->qty }}</span>
                        </div>
                    </div>
                    <div>
                        <span>$ {{ $deal->deal_price }}</span>
                    </div>
                </div>
                @endforeach
                @endif

                @if((!is_null($orderDeals) && count($orderDeals) > 0) || count($products) > 0)
                <!-- Total -->
                <div style="display: flex;
                justify-content: space-between;
                margin-top: 1rem;
            ">
                    <span>Total</span>
                    <span>$ {{ number_format($total, 2) }}</span>
                </div>
                @endif
            </div>
            <!-- Products Wrapper Ends -->

<!-- Payment Info -->

            <div style="display: flex; justify-content: space-between">
                <a href="https://deliveries.420finder.net/orders?order={{ $orderInfo->id }}" style="background: #f8971c;
                    color: white;
                    border: 1px solid #f8971c;
                    margin: 2rem auto 0;
                    text-decoration: none;
                    border-radius: 3px;
                    padding: 0.3rem;">
                    View Order
                </a>
            </div>

<div style="margin-top: 2rem;">
    <div
        style="font-weight: bold;                                                                                   border-bottom: 1px solid #ccc;padding-bottom: 0.5rem; display: inline-block;padding-right: 0.3rem;">
        <span>Order Details</span>
    </div>
    <div>
        <p style="margin: 0.8rem 0 0;">
            <span>
                Name on order:
            </span> <span style="color: #4b4b4b;">
                {{ $orderInfo->nameonorder }}
            </span>
        </p>
        <p style="margin: 0.8rem 0 0;">
            <span>
                Name on id:
            </span>
            <span style="color: #4b4b4b;">
                {{ $orderInfo->nameonid }} </span>
        </p>

        <p>
            <span>
                Id type:
            </span>
            <span style="color: #4b4b4b;">
                {{ $orderInfo->id_type }} </span>
        </p>
        <p>
            <span>
                Id number:
            </span>
            <span style="color: #4b4b4b;">
                {{ $orderInfo->id_number }} </span>

        </p>

        <p>
            <span>
                Phone Number:
            </span>
            <span style="color: #4b4b4b;">
                {{ $orderInfo->customer_phone }} </span>
        </p>

        <p>
            <span>
                Delivery Address:
            </span>
            <span style="color: #4b4b4b;">
                {{ $orderInfo->delivery_address }} </span>
        </p>

    </div>
</div>

<!-- Payment Info Ends -->

<!-- Customer Info -->
 <div
 style="margin-top: 2rem;">
 <div
     style="font-weight: bold;                                                                                   border-bottom: 1px solid #ccc;padding-bottom: 0.5rem; display: inline-block;padding-right: 0.3rem;">
     <span>Customer
         Details</span>
 </div>
 <div>
     <p
         style="margin: 0.8rem 0 0;">
         <span>
             Name:
         </span> <span
             style="color: #4b4b4b;">
             {{ $customerDetail->name }}
         </span>
     </p>
     <p
         style="margin: 0.8rem 0 0;">
         <span>
            Phone:
         </span>
         <span
             style="color: #4b4b4b;">
                {{ $customerDetail->phone }}</span>
        </p>
    <p style="margin: 0.8rem 0 0;">
<span>
    Email:
    </span>
    <span
    style="color: #4b4b4b;">
    {{ $customerDetail->email }} </span>
</p>
<p style="margin: 0.8rem 0 0;">
<span>
Address:
</span>
<span
style="color: #4b4b4b;">
{{ $customerDetail->delivery_address }}</span>

</p>
 </div>
</div>
<!-- Customer Info Ends -->

            <div style="display: flex; justify-content: space-between; margin: 1rem 0;">
                <a href="https://www.420finder.net" style="margin: auto">
                    <img src="https://www.420finder.net/assets/img/logo.png" alt="Site Logo" style="width: 100px;
                    height: 57px;">
                </a>
            </div>

        </div>
    </div>

</body>

</html>
